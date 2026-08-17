<?php
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
$_SERVER['DOCUMENT_ROOT'] = '/var/www/bx31/data/www/td-spets.ru';

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!CModule::IncludeModule('iblock')) {
    die('Модуль iblock не подключен');
}
if (!CModule::IncludeModule('catalog')) {
    die('Модуль catalog не подключен');
}

$logFile = $_SERVER['DOCUMENT_ROOT'] . '/import_log.txt';
file_put_contents($logFile, "Начало импорта: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

$iblockId = 13;

// Путь к XML файлу
$xmlFilePath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/catalog_export/brodeks/yandex_dealer.xml';
$csvFilePath = $_SERVER['DOCUMENT_ROOT'] . '/brodeks.csv';

if (!file_exists($xmlFilePath)) {
    $error = "XML файл не найден: " . $xmlFilePath;
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    die($error);
}

$csvFilePath = $_SERVER['DOCUMENT_ROOT'] . '/brodeks.csv';
if (!file_exists($csvFilePath)) {
    $error = "CSV файл не найден: " . $csvFilePath;
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    die($error);
}

$ymlContent = file_get_contents($xmlFilePath);
if (!$ymlContent) {
    $error = "Не удалось прочитать XML файл";
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    die($error);
}

$xml = simplexml_load_string($ymlContent);
if (!$xml) {
    $error = "Ошибка парсинга XML";
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    die($error);
}

$categories = [];

// Импорт категорий
foreach ($xml->shop->categories->category as $category) {
    $categoryId = (string)$category['id'];
    $categoryName = (string)$category;
    $parentId = isset($category['parentId']) ? (string)$category['parentId'] : 0;

    $sectionId = createOrUpdateCategory($iblockId, $categoryId, $categoryName, $parentId);
    $categories[$categoryId] = $sectionId;
}

// Группировка товаров по базовому названию
$productGroups = [];
$productsProcessed = 0;
$productsWithImages = 0;
$imagesDownloaded = 0;
$activeProducts = 0;
$inactiveProducts = 0;
$groupedProducts = 0;

// Читаем CSV файл для получения остатков
$csvProducts = getSimpleProductsList($csvFilePath);

// Сначала группируем товары
foreach ($xml->shop->offers->offer as $offer) {
    $productId = (string)$offer['id'];
    $name = (string)$offer->name;
    $price = (float)$offer->price;
    $categoryId = (string)$offer->categoryId;
    $description = (string)$offer->description;
    $picture = (string)$offer->picture;

    // Парсим параметры
    $params = parseOfferParams($offer);

    // определение доступности товара
    $available = false;
    if (isset($offer['available'])) {
        $available = ((string)$offer['available'] === 'true' || (string)$offer['available'] === 'true');
    }

    // Альтернативные варианты проверки доступности
    if (!$available && isset($offer->quantity)) {
        $quantity = (int)$offer->quantity;
        $available = ($quantity > 0);
    }

    $sectionId = isset($categories[$categoryId]) ? $categories[$categoryId] : 0;
    
    // Извлекаем базовое название и размер
    $baseData = extractProductBaseInfo($name);
    $baseName = $baseData['name'];
    $size = $baseData['size'];
    
    // Группируем товары по базовому названию
    if (!isset($productGroups[$baseName])) {
        $productGroups[$baseName] = [
            'sectionId' => $sectionId,
            'categoryId' => $categoryId,
            'sizes' => [],
            'prices' => [],
            'availableSizes' => [],
            'allOffers' => [],
            'firstOffer' => null,
            'categoryName' => isset($categories[$categoryId]) ? getCategoryName($categories[$categoryId]) : ''
        ];
    }
    
    // Сохраняем информацию о размере
    if ($size) {
        $productGroups[$baseName]['sizes'][] = $size;
        
        // Сохраняем цену для этого размера
        if (!isset($productGroups[$baseName]['prices'][$size])) {
            $productGroups[$baseName]['prices'][$size] = $price;
        }
        
        // Отмечаем доступные размеры
        if ($available) {
            $productGroups[$baseName]['availableSizes'][] = $size;
        }
    }
    
    // Сохраняем полные данные оффера
    $offerData = [
        'xmlId' => $productId,
        'name' => $name,
        'size' => $size,
        'price' => $price,
        'available' => $available,
        'picture' => $picture,
        'description' => $description,
        'params' => $params,
        'sectionId' => $sectionId
    ];
    
    $productGroups[$baseName]['allOffers'][] = $offerData;
    
    // Сохраняем данные первого оффера для основного товара
    if (!$productGroups[$baseName]['firstOffer']) {
        $productGroups[$baseName]['firstOffer'] = $offerData;
    }
    
    $productsProcessed++;
    if (!empty($picture)) $productsWithImages++;
    if ($available) $activeProducts++;
    else $inactiveProducts++;
}

// Теперь создаем товары из групп
foreach ($productGroups as $baseName => $groupData) {
    // Если есть несколько размеров - создаем группированный товар
    if (count($groupData['sizes']) > 1) {
        $elementId = createGroupedProduct($iblockId, $baseName, $groupData, $csvProducts);
        if ($elementId) {
            $groupedProducts++;
            echo "Создан группированный товар: {$baseName} (ID: {$elementId})<br>";
            echo "Размеры: " . implode(', ', array_unique($groupData['sizes'])) . "<br>";
            
            // Деактивируем старые отдельные товары
            deactivateOldSizeVariants($baseName, $elementId);
        }
    } else {
        // Если только один размер - создаем обычный товар
        $firstOffer = $groupData['firstOffer'];
        $elementId = createOrUpdateProduct(
            $iblockId, 
            $firstOffer['xmlId'], 
            $firstOffer['name'], 
            $firstOffer['description'], 
            $firstOffer['price'], 
            $firstOffer['sectionId'], 
            $firstOffer['available'], 
            $firstOffer['picture'], 
            $firstOffer['params']
        );
    }
}

// Деактивация пустых категорий (рекурсивно)
$emptyCategoriesDeactivated = deactivateEmptyCategoriesRecursive($iblockId);

// Логируем результаты
file_put_contents($logFile, "Импорт завершен: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
file_put_contents($logFile, "Обработано офферов: {$productsProcessed}\n", FILE_APPEND);
file_put_contents($logFile, "Создано группированных товаров: {$groupedProducts}\n", FILE_APPEND);
file_put_contents($logFile, "Активных товаров: {$activeProducts}\n", FILE_APPEND);
file_put_contents($logFile, "Неактивных товаров: {$inactiveProducts}\n", FILE_APPEND);
file_put_contents($logFile, "Товаров с изображениями: {$productsWithImages}\n", FILE_APPEND);
file_put_contents($logFile, "Загружено изображений: {$imagesDownloaded}\n", FILE_APPEND);
file_put_contents($logFile, "Деактивировано пустых категорий: {$emptyCategoriesDeactivated}\n", FILE_APPEND);

/**
 * Извлекает базовое название и размер из полного названия
 */
function extractProductBaseInfo($fullName) {
    // Убираем размер в конце названия в скобках
    $patterns = [
        '/\s*\([XSMLXLXXL0-9\/\-\s]+\)\s*$/iu',  // (S), (M), (L)
        '/\s*Размер\s*:\s*[XSMLXLXXL0-9\/\-]+\s*$/iu', // Размер: S
        '/\s*-\s*[XSMLXLXXL0-9\/\-]+\s*$/iu',    // -S, -M
        '/\s*,\s*[XSMLXLXXL0-9\/\-]+\s*$/iu',    // , S, ,M
    ];
    
    $baseName = $fullName;
    $size = '';
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $fullName, $matches)) {
            // Извлекаем размер
            if (preg_match('/[XSMLXLXXL0-9\/\-]+/iu', $matches[0], $sizeMatch)) {
                $size = trim($sizeMatch[0]);
            }
            
            // Убираем размер из названия
            $baseName = preg_replace($pattern, '', $fullName);
            $baseName = trim($baseName);
            break;
        }
    }
    
    // Если не нашли размер по паттернам, пробуем другие варианты
    if (empty($size)) {
        // Проверяем, есть ли размер как отдельное слово в конце
        $words = explode(' ', $fullName);
        $lastWord = end($words);
        
        $sizePatterns = [
            '/^[XSMLXLXXL]$/iu',
            '/^[0-9]{1,3}$/',
            '/^[0-9]{1,3}\/[0-9]{1,3}$/'
        ];
        
        foreach ($sizePatterns as $sizePattern) {
            if (preg_match($sizePattern, $lastWord)) {
                $size = $lastWord;
                array_pop($words); // Убираем размер из названия
                $baseName = implode(' ', $words);
                break;
            }
        }
    }
    
    // Очищаем название от лишних символов
    $baseName = trim($baseName, " ,.-");
    
    return [
        'name' => $baseName,
        'size' => $size
    ];
}

/**
 * Создает один товар со всеми размерами
 */
function createGroupedProduct($iblockId, $baseName, $groupData, $csvProducts) {
    $firstOffer = $groupData['firstOffer'];
    $sectionId = $groupData['sectionId'];
    
    // Получаем уникальные размеры
    $allSizes = array_unique($groupData['sizes']);
    sort($allSizes);
    
    // Формируем описание с информацией о размерах
    $description = $firstOffer['description'];
    $sizeInfo = "\n\n<b>Доступные размеры:</b> " . implode(', ', $allSizes);
    
    // Если есть доступные размеры, показываем их
    $availableSizes = array_unique($groupData['availableSizes']);
    if (!empty($availableSizes)) {
        $sizeInfo .= "\n<b>В наличии:</b> " . implode(', ', $availableSizes);
    }
    
    // Проверяем, есть ли уже такой товар
    $xmlId = 'GROUP_' . md5($baseName);
    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'XML_ID' => $xmlId
    ];
    
    $dbRes = CIBlockElement::GetList([], $arFilter);
    
    if ($existingProduct = $dbRes->Fetch()) {
        // Обновляем существующий товар
        $elementId = $existingProduct['ID'];
        
        // Обновляем размеры
        CIBlockElement::SetPropertyValuesEx(
            $elementId,
            $iblockId,
            ['RAZMER' => $allSizes] // Множественное свойство
        );
        
        // Обновляем описание
        updateDescription($elementId, $description . $sizeInfo);
        
        // Устанавливаем минимальную цену
        $minPrice = !empty($groupData['prices']) ? min($groupData['prices']) : $firstOffer['price'];
        updatePrice($elementId, $minPrice);
        
        // Обновляем доступность (если есть хоть один доступный размер)
        $isAvailable = !empty($availableSizes);
        updateProductAvailability($elementId, $isAvailable);
        
        // Обновляем количество из CSV
        updateQuantityFromCSV($elementId, $baseName, $csvProducts, $isAvailable);
        
        return $elementId;
        
    } else {
        // Создаем новый товар
        $code = generateCode($baseName);
        
        $arFields = [
            'IBLOCK_ID' => $iblockId,
            'XML_ID' => $xmlId,
            'NAME' => $baseName,
            'CODE' => $code,
            'DETAIL_TEXT' => $description . $sizeInfo,
            'ACTIVE' => 'Y',
            'SORT' => 100,
            'IBLOCK_SECTION_ID' => $sectionId
        ];
        
        // Добавляем картинку
        if (!empty($firstOffer['picture'])) {
            $fileArray = downloadImage($firstOffer['picture'], $xmlId);
            if ($fileArray) {
                $arFields['DETAIL_PICTURE'] = $fileArray;
                $arFields['PREVIEW_PICTURE'] = $fileArray;
            }
        }
        
        // Подготавливаем свойства
        $propertyValues = [
            'RAZMER' => $allSizes, // Размеры как множественное свойство
        ];
        
        // Добавляем остальные параметры (кроме размеров)
        foreach ($firstOffer['params'] as $paramName => $paramValue) {
            $propertyId = findPropertyByName($iblockId, $paramName);
            if ($propertyId && !in_array(strtolower($paramName), ['размер', 'size'])) {
                $propertyValues[$propertyId] = $paramValue;
            }
        }
        
        // Добавляем свойство с названием категории
        if (!empty($groupData['categoryName'])) {
            $propertyValues[114] = $groupData['categoryName'];
        }
        
        $arFields['PROPERTY_VALUES'] = $propertyValues;
        
        $el = new CIBlockElement();
        $elementId = $el->Add($arFields);
        
        if ($elementId) {
            // Устанавливаем минимальную цену
            $minPrice = !empty($groupData['prices']) ? min($groupData['prices']) : $firstOffer['price'];
            addPrice($elementId, $minPrice);
            
            // Устанавливаем количество из CSV
            $isAvailable = !empty($availableSizes);
            addQuantityFromCSV($elementId, $baseName, $csvProducts, $isAvailable);
            
            return $elementId;
        }
    }
    
    return 0;
}

/**
 * Обновляет доступность товара
 */
function updateProductAvailability($elementId, $isAvailable) {
    $arFields = [
        'ACTIVE' => $isAvailable ? 'Y' : 'N'
    ];
    
    $el = new CIBlockElement();
    if ($el->Update($elementId, $arFields)) {
        return true;
    }
    return false;
}

/**
 * Обновляет количество из CSV для товара
 */
function updateQuantityFromCSV($elementId, $baseName, $csvProducts, $isAvailable) {
    $totalStock = 0;
    
    // Ищем все варианты этого товара в CSV
    foreach ($csvProducts as $product) {
        // Проверяем, содержит ли название товара базовое название
        $productBaseData = extractProductBaseInfo($product['name']);
        if ($productBaseData['name'] == $baseName) {
            $totalStock += (int)$product['stock'];
        }
    }
    
    // Если товар доступен, устанавливаем суммарный остаток
    $quantity = $isAvailable ? $totalStock : 0;
    updateQuantity($elementId, $quantity);
}

/**
 * Добавляет количество из CSV для нового товара
 */
function addQuantityFromCSV($elementId, $baseName, $csvProducts, $isAvailable) {
    $totalStock = 0;
    
    // Ищем все варианты этого товара в CSV
    foreach ($csvProducts as $product) {
        // Проверяем, содержит ли название товара базовое название
        $productBaseData = extractProductBaseInfo($product['name']);
        if ($productBaseData['name'] == $baseName) {
            $totalStock += (int)$product['stock'];
        }
    }
    
    // Если товар доступен, устанавливаем суммарный остаток
    $quantity = $isAvailable ? $totalStock : 0;
    addQuantity($elementId, $quantity);
}

/**
 * Деактивирует старые разрозненные товары
 */
function deactivateOldSizeVariants($baseName, $newProductId) {
    global $iblockId;
    
    // Ищем товары с названиями, содержащими размеры
    $dbRes = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => $iblockId,
            'NAME' => $baseName . '%',
            '!ID' => $newProductId
        ],
        false,
        false,
        ['ID', 'NAME']
    );
    
    $deactivated = 0;
    while ($element = $dbRes->Fetch()) {
        // Проверяем, содержит ли название размер
        $hasSize = preg_match('/\([XSMLXLXXL0-9\/\-]+\)$/iu', $element['NAME']) 
                || preg_match('/\s[0-9]{1,3}$/', $element['NAME'])
                || preg_match('/\s[XSMLXLXXL]$/iu', $element['NAME']);
        
        if ($hasSize) {
            $el = new CIBlockElement();
            $el->Update($element['ID'], ['ACTIVE' => 'N']);
            $deactivated++;
            echo "Деактивирован старый товар: {$element['NAME']} (ID: {$element['ID']})<br>";
        }
    }
    
    return $deactivated;
}

// Остальные функции остаются без изменений...

function getPropertyMapping()
{
    return [
        'Цвета' => 'Цвет',
        'Размеры' => 'Размер',
        'Материалы' => 'Материал',
        'Производители' => 'Производитель',
        'Страны' => 'Страна',
        'Габариты' => 'Габариты',
        'Вес товаров' => 'Вес',
        'Длины' => 'Длина',
        'Ширины' => 'Ширина',
        'Высоты' => 'Высота',
        'Модели' => 'Модель',
        'Типы' => 'Тип',
        'Виды' => 'Вид',
        'Формы' => 'Форма',
        'Стили' => 'Стиль',
        'Бренды' => 'Производитель',
    ];
}

/**
 * Автоматическое преобразование во множественное число
 */
function autoConvertToSingular($plural)
{
    $rules = [
        '/ы$/u' => '',    // цветы -> цвет
        '/а$/u' => '',    // размера -> размер
        '/и$/u' => 'ь',   // двери -> дверь
        '/ья$/u' => 'ье', // платья -> платье
        '/ья$/u' => 'ье', // перья -> перо
        '/ей$/u' => 'ь',  // дверей -> дверь
        '/ости$/u' => 'ость', // возможности -> возможность
    ];

    foreach ($rules as $pattern => $replacement) {
        $singular = preg_replace($pattern, $replacement, $plural);
        if ($singular !== $plural) {
            return $singular;
        }
    }

    // Если не сработало ни одно правило, возвращаем исходное
    return $plural;
}

function normalizeParamName($paramName)
{
    $mapping = getPropertyMapping();

    // Прямое соответствие из карты
    if (isset($mapping[$paramName])) {
        return $mapping[$paramName];
    }

    // Автоматическое преобразование (резервный вариант)
    $singular = autoConvertToSingular($paramName);

    return $singular;
}

/**
 * Парсинг параметров оффера
 */
function parseOfferParams($offer)
{
    $params = [];

    foreach ($offer->param as $param) {
        $originalName = (string)$param['name'];
        $value = trim((string)$param);

        if (!empty($originalName) && !empty($value)) {
            // Нормализуем название параметра
            $normalizedName = normalizeParamName($originalName);
            $params[$normalizedName] = $value;
        }
    }
    return $params;
}

/**
 * Функция для генерации символьного кода
 */
function generateCode($name)
{
    $code = preg_replace('/[^a-zA-Z0-9_]/', '_', $name);
    $code = preg_replace('/_+/', '_', $code);
    $code = trim($code, '_');
    $code = strtolower($code);
    $str = mb_strtolower($name, 'UTF-8');
    return $code ?: $str;
}

/**
 * Функция для загрузки картинки
 */
function downloadImage($imageUrl, $elementId)
{
    global $imagesDownloaded;

    if (empty($imageUrl)) {
        return false;
    }

    // Создаем папку для загрузки если нет
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/import_temp/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Получаем расширение файла
    $urlPath = parse_url($imageUrl, PHP_URL_PATH);
    $extension = pathinfo($urlPath, PATHINFO_EXTENSION);
    if (empty($extension)) {
        $extension = 'jpg';
    }

    $localFile = $uploadDir . $elementId . '_' . md5($imageUrl) . '.' . $extension;

    if (file_exists($localFile)) {
        return createFileArray($localFile);
    }
    
    $header = array(
        'Proxy-Authorization: Basic ' . base64_encode('C72DNt:VacNdP')
    );
    $opts = array(
        "http" => array(
            "method" => 'GET',
            "header" => implode("\r\n", $header),
            'ignore_errors' => true
        )
    );
    $opts['http']['proxy'] = '45.93.69.81:8000';
    $opts['http']['request_fulluri'] = true;

    $context = stream_context_create($opts);

    $imageContent = @file_get_contents($imageUrl, false, $context);

    if ($imageContent === false) {
        echo "Ошибка загрузки изображения: {$imageUrl}<br>";
        return false;
    }

    if (file_put_contents($localFile, $imageContent) === false) {
        return false;
    }

    if ($extension == 'webp') {
        $oldlocalFile = $localFile;
        $localFile = $uploadDir . $elementId . '_' . md5($imageUrl) . '.' . 'png';
        $res = webp_to_png_cli($oldlocalFile, $localFile);
    }

    $imagesDownloaded++;
    return createFileArray($localFile);
}

function webp_to_png_cli(string $sourcePath, string $destPath): bool
{
    if (!file_exists($sourcePath)) {
        return false;
    }
    $cmd = sprintf(
        'dwebp %s -o %s 2>&1',
        escapeshellarg($sourcePath),
        escapeshellarg($destPath)
    );
    exec($cmd, $output, $ret);
    return $ret === 0 && file_exists($destPath);
}

function downloadWithFileGetContents($url)
{
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
        'http' => [
            'timeout' => 30,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]
    ]);

    $data = file_get_contents($url, false, $context);
    return $data;
}

function createFileArray($filePath)
{
    if (!file_exists($filePath)) {
        return false;
    }

    return [
        'name' => basename($filePath),
        'size' => filesize($filePath),
        'tmp_name' => $filePath,
        'type' => mime_content_type($filePath),
        'error' => 0
    ];
}

function createOrUpdateCategory($iblockId, $xmlId, $name, $parentId = 0)
{
    $code = generateCode($name);

    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'XML_ID' => $xmlId
    ];

    $dbRes = CIBlockSection::GetList([], $arFilter);

    if ($existingSection = $dbRes->Fetch()) {
        echo "Обновляем категорию: {$name}<br>";
        $sectionId = $existingSection['ID'];

        if (empty($existingSection['PICTURE'])) {
            setCategoryImageFromProduct($sectionId, $iblockId);
        }

        return $sectionId;
    } else {
        $arFields = [
            'IBLOCK_ID' => $iblockId,
            'XML_ID' => $xmlId,
            'NAME' => $name,
            'CODE' => $code,
            'ACTIVE' => 'Y',
            'SORT' => 100,
        ];

        if ($parentId > 0) {
            $parentFilter = ['IBLOCK_ID' => $iblockId, 'XML_ID' => $parentId];
            $parentRes = CIBlockSection::GetList([], $parentFilter);
            if ($parentSection = $parentRes->Fetch()) {
                $arFields['IBLOCK_SECTION_ID'] = $parentSection['ID'];
            }
        }

        $bs = new CIBlockSection();
        $sectionId = $bs->Add($arFields);

        if ($sectionId) {
            echo "Создана категория: {$name} (ID: {$sectionId})<br>";
            setCategoryImageFromProduct($sectionId, $iblockId);
            return $sectionId;
        } else {
            echo "Ошибка создания категории: {$name} - " . $bs->LAST_ERROR . "<br>";
            return 0;
        }
    }
}

function copyProductImageToCategory($productImageId, $sectionId)
{
    if (empty($productImageId)) {
        return false;
    }

    $arFile = CFile::GetFileArray($productImageId);
    if (!$arFile) {
        return false;
    }

    $newFileId = CFile::CopyFile($productImageId);
    if ($newFileId) {
        $fileArray = CFile::MakeFileArray($newFileId);
        $bs = new CIBlockSection();
        if ($bs->Update($sectionId, ['PICTURE' => $fileArray])) {
            return true;
        } else {
            echo "Ошибка обновления изображения категории: " . $bs->LAST_ERROR . "<br>";
            return false;
        }
    }

    return false;
}

function setCategoryImageFromProduct($sectionId, $iblockId)
{
    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'SECTION_ID' => $sectionId,
        'ACTIVE' => 'Y',
        '!DETAIL_PICTURE' => false
    ];

    $dbRes = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        $arFilter,
        false,
        ['nTopCount' => 1],
        ['ID', 'DETAIL_PICTURE', 'NAME']
    );

    if ($product = $dbRes->Fetch()) {
        if (!empty($product['DETAIL_PICTURE'])) {
            copyProductImageToCategory($product['DETAIL_PICTURE'], $sectionId);
            return true;
        }
    }

    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'SECTION_ID' => $sectionId,
        'ACTIVE' => 'Y',
        '!PREVIEW_PICTURE' => false
    ];

    $dbRes = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        $arFilter,
        false,
        ['nTopCount' => 1],
        ['ID', 'PREVIEW_PICTURE', 'NAME']
    );

    if ($product = $dbRes->Fetch()) {
        if (!empty($product['PREVIEW_PICTURE'])) {
            copyProductImageToCategory($product['PREVIEW_PICTURE'], $sectionId);
            return true;
        }
    }

    return false;
}

function createOrUpdateProduct($iblockId, $xmlId, $name, $description, $price, $sectionId, $available = true, $pictureUrl = '', $params = [])
{
    $code = generateCode($name);
    $categoryName = '';
    if ($sectionId > 0) {
        $categoryName = getCategoryName($sectionId);
    }

    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'XML_ID' => $xmlId
    ];

    $dbRes = CIBlockElement::GetList([], $arFilter);
    if ($existingProduct = $dbRes->Fetch()) {
        return updateExistingProduct($existingProduct, $name, $description, $price, $available, $pictureUrl, $iblockId, $categoryName, $params);
    }

    $duplicateFilter = [
        'IBLOCK_ID' => $iblockId,
        'NAME' => $name,
        'SECTION_ID' => $sectionId
    ];

    $dbResDuplicate = CIBlockElement::GetList([], $duplicateFilter);
    if ($duplicateProduct = $dbResDuplicate->Fetch()) {
        return 0;
    }

    return createNewProduct($iblockId, $xmlId, $name, $description, $price, $sectionId, $available, $pictureUrl, $code, $categoryName, $params);
}

function updateExistingProduct($existingProduct, $name, $description, $price, $available, $pictureUrl, $iblockId, $categoryName, $params = [], $csvProducts = null)
{
    if ($csvProducts === null) {
        $csvFilePath = $_SERVER['DOCUMENT_ROOT'] . '/brodeks.csv';
        $csvProducts = getSimpleProductsList($csvFilePath);
    }

    $arUpdateFields = [
        'ACTIVE' => $available ? 'Y' : 'N'
    ];

    if (!empty($pictureUrl)) {
        $fileArray = downloadImage($pictureUrl, $existingProduct['ID']);
        if ($fileArray) {
            $arUpdateFields['DETAIL_PICTURE'] = $fileArray;
            $arUpdateFields['PREVIEW_PICTURE'] = $fileArray;
        }
    }

    $el = new CIBlockElement();
    if ($el->Update($existingProduct['ID'], $arUpdateFields)) {
    } else {
        echo "Ошибка обновления товара: " . $el->LAST_ERROR . "<br>";
    }

    updatePrice($existingProduct['ID'], $price);

    foreach ($csvProducts as $product) {
        if ($product['name'] == $name) {
            updateQuantity($existingProduct['ID'], $available ? $product['stock'] : 0);
            break;
        }
    }

    if (!empty($categoryName)) {
        updateCategoryProperty($existingProduct['ID'], $iblockId, 114, $categoryName);
    }

    updateDescription($existingProduct['ID'], $description);

    if (!empty($params)) {
        updateProductParams($existingProduct['ID'], $iblockId, $params);
    }

    return $existingProduct['ID'];
}

function updateProductParams($elementId, $iblockId, $params)
{
    $propertyValues = [];

    foreach ($params as $paramName => $paramValue) {
        $propertyId = findPropertyByName($iblockId, $paramName);

        if ($propertyId) {
            if ($paramName === 'Особенность' || $paramName === 'Особенности') {
                $features = explode("\n", trim($paramValue));
                $features = array_filter($features, function ($line) {
                    return trim($line) !== '';
                });
                $paramValue = implode("<br>", $features);
            }

            $propertyValues[$propertyId] = $paramValue;
        } else {
            echo "<span style='color: orange;'>Свойство '{$paramName}' не найдено в инфоблоке</span><br>";
        }
    }

    if (!empty($propertyValues)) {
        CIBlockElement::SetPropertyValuesEx($elementId, $iblockId, $propertyValues);
    }
}

function findPropertyByName($iblockId, $propertyName)
{
    static $propertiesCache = [];

    if (!isset($propertiesCache[$iblockId])) {
        $propertiesCache[$iblockId] = [];
        $dbProps = CIBlockProperty::GetList([], ['IBLOCK_ID' => $iblockId]);
        while ($prop = $dbProps->Fetch()) {
            $propertiesCache[$iblockId][$prop['NAME']] = $prop['ID'];
            if (!empty($prop['CODE'])) {
                $propertiesCache[$iblockId][$prop['CODE']] = $prop['ID'];
            }
        }
    }

    if (isset($propertiesCache[$iblockId][$propertyName])) {
        return $propertiesCache[$iblockId][$propertyName];
    }

    $normalizedName = normalizeParamName($propertyName);
    if (isset($propertiesCache[$iblockId][$normalizedName])) {
        return $propertiesCache[$iblockId][$normalizedName];
    }

    foreach ($propertiesCache[$iblockId] as $name => $id) {
        if (strcasecmp($name, $propertyName) === 0) {
            return $id;
        }
        if (strcasecmp($name, $normalizedName) === 0) {
            return $id;
        }
    }

    file_put_contents(
        $_SERVER['DOCUMENT_ROOT'] . '/property_debug.log',
        "Не найдено свойство: '{$propertyName}' (нормализовано: '{$normalizedName}')" . PHP_EOL,
        FILE_APPEND
    );

    return false;
}

function getSimpleProductsList($csvFilePath)
{
    $products = [];
    $handle = fopen($csvFilePath, 'r');

    for ($i = 0; $i < 4; $i++) {
        fgetcsv($handle, 0, ';');
    }

    fgetcsv($handle, 0, ';');

    while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
        if (!empty($row[0]) && isset($row[3])) {
            $products[] = [
                'name' => $row[0],
                'stock' => $row[3]
            ];
        }
    }

    fclose($handle);
    return $products;
}

function createNewProduct($iblockId, $xmlId, $name, $description, $price, $sectionId, $available, $pictureUrl, $code, $categoryName, $params = [])
{
    $arFields = [
        'IBLOCK_ID' => $iblockId,
        'XML_ID' => $xmlId,
        'NAME' => $name,
        'CODE' => $code,
        'DETAIL_TEXT' => $description,
        'ACTIVE' => $available ? 'Y' : 'N',
        'SORT' => 100,
    ];

    if ($sectionId > 0) {
        $arFields['IBLOCK_SECTION_ID'] = $sectionId;
    }

    $fileArray = false;
    if (!empty($pictureUrl)) {
        $fileArray = downloadImage($pictureUrl, $xmlId);
        if ($fileArray) {
            $arFields['DETAIL_PICTURE'] = $fileArray;
            $arFields['PREVIEW_PICTURE'] = $fileArray;
        }
    }

    $propertyValues = [];

    if (!empty($categoryName)) {
        $propertyValues[114] = $categoryName;
    }

    if (!empty($params)) {
        foreach ($params as $paramName => $paramValue) {
            $propertyId = findPropertyByName($iblockId, $paramName);
            if ($propertyId) {
                $propertyValues[$propertyId] = $paramValue;
            } else {
                echo "<span style='color: orange;'>Свойство '{$paramName}' не найдено, пропускаем</span><br>";
            }
        }
    }

    if (!empty($propertyValues)) {
        $arFields['PROPERTY_VALUES'] = $propertyValues;
    }

    $el = new CIBlockElement();
    $newId = $el->Add($arFields);

    if ($newId) {
        addPrice($newId, $price);

        $csvFilePath = $_SERVER['DOCUMENT_ROOT'] . '/brodeks.csv';
        $products = getSimpleProductsList($csvFilePath);
        $quantity = 0;

        foreach ($products as $product) {
            if ($product['name'] == $name) {
                $quantity = $available ? $product['stock'] : 0;
                break;
            }
        }

        addQuantity($newId, $quantity);

        if (!empty($pictureUrl) && !$fileArray) {
            $fileArray = downloadImage($pictureUrl, $xmlId);
            if ($fileArray) {
                CIBlockElement::SetPropertyValuesEx($newId, $iblockId, ['MORE_PHOTO' => $fileArray]);
            }
        }

        if (!empty($propertyValues)) {
            CIBlockElement::SetPropertyValuesEx($newId, $iblockId, $propertyValues);
        }

        return $newId;
    } else {
        echo "<span style='color: red;'>Ошибка создания товара: {$name} - " . $el->LAST_ERROR . "</span><br>";
        return 0;
    }
}

function updateDescription($elementId, $description)
{
    $arFields = [
        'DETAIL_TEXT' => $description
    ];

    $el = new CIBlockElement();
    if ($el->Update($elementId, $arFields)) {
    } else {
        echo "Ошибка обновления описания: " . $el->LAST_ERROR . "<br>";
    }
}

function getCategoryName($sectionId)
{
    $dbRes = CIBlockSection::GetByID($sectionId);
    if ($section = $dbRes->Fetch()) {
        return $section['NAME'];
    }
    return '';
}

function updateCategoryProperty($elementId, $iblockId, $propertyId, $value)
{
    CIBlockElement::SetPropertyValuesEx($elementId, $iblockId, [$propertyId => $value]);
}

function updatePicture($elementId, $pictureUrl, $iblockId)
{
    $fileArray = downloadImage($pictureUrl, $elementId);
    if ($fileArray) {
        $arFields = [
            'DETAIL_PICTURE' => $fileArray,
            'PREVIEW_PICTURE' => $fileArray
        ];
        $el = new CIBlockElement();
        if ($el->Update($elementId, $arFields)) {
        }

        CIBlockElement::SetPropertyValuesEx($elementId, $iblockId, ['MORE_PHOTO' => $fileArray]);
    }
}

function addPrice($productId, $price)
{
    $arFields = [
        'PRODUCT_ID' => $productId,
        'CATALOG_GROUP_ID' => 1,
        'PRICE' => $price,
        'CURRENCY' => 'RUB'
    ];

    if (CPrice::Add($arFields)) {
    } else {
        echo "Ошибка добавления цены<br>";
    }
}

function updatePrice($productId, $price)
{
    $dbRes = CPrice::GetList([], ['PRODUCT_ID' => $productId]);
    if ($existingPrice = $dbRes->Fetch()) {
        if (CPrice::Update($existingPrice['ID'], ['PRICE' => $price])) {
        } else {
            echo "Ошибка обновления цены<br>";
        }
    } else {
        addPrice($productId, $price);
    }
}

function addQuantity($productId, $quantity = 10)
{
    $arFields = [
        'ID' => $productId,
        'QUANTITY' => $quantity,
        'CAT_BASE_QUANTITY' => $quantity
    ];

    if (CCatalogProduct::Add($arFields)) {
    } else {
        echo "Ошибка добавления количества<br>";
    }
}

function updateQuantity($productId, $quantity = 10)
{
    $arFields = [
        'QUANTITY' => $quantity,
        'CAT_BASE_QUANTITY' => $quantity
    ];

    if (CCatalogProduct::Update($productId, $arFields)) {
    } else {
        echo "Ошибка обновления количества<br>";
    }
}

function deactivateCategory($sectionId)
{
    $dbSection = CIBlockSection::GetByID($sectionId);
    if ($section = $dbSection->Fetch()) {
        $categoryName = $section['NAME'];
    } else {
        $categoryName = "Unknown";
    }

    $bs = new CIBlockSection();
    if ($bs->Update($sectionId, ['ACTIVE' => 'N'])) {
        return true;
    }

    return false;
}

function isCategoryTrulyEmpty($sectionId, $iblockId)
{
    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'SECTION_ID' => $sectionId,
        'ACTIVE' => 'Y'
    ];

    $dbRes = CIBlockElement::GetList([], $arFilter, false, false, ['ID']);
    if ($dbRes->Fetch()) {
        return false;
    }

    $dbSubSections = CIBlockSection::GetList([], [
        'IBLOCK_ID' => $iblockId,
        'SECTION_ID' => $sectionId,
        'ACTIVE' => 'Y'
    ]);

    while ($subSection = $dbSubSections->Fetch()) {
        if (!isCategoryTrulyEmpty($subSection['ID'], $iblockId)) {
            return false;
        }
    }

    return true;
}

function deactivateEmptyCategoriesRecursive($iblockId)
{
    $deactivatedCount = 0;

    $dbSections = CIBlockSection::GetList(
        ['LEFT_MARGIN' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'],
        false,
        ['ID', 'IBLOCK_SECTION_ID']
    );

    $sections = [];
    while ($section = $dbSections->Fetch()) {
        $sections[$section['ID']] = $section;
    }

    foreach (array_reverse($sections, true) as $sectionId => $section) {
        if (isCategoryTrulyEmpty($sectionId, $iblockId)) {
            if (deactivateCategory($sectionId)) {
                $deactivatedCount++;
            }
        }
    }

    return $deactivatedCount;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');