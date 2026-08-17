<?php
// Включим вывод всех ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Начнем сессию
if (session_status() == PHP_SESSION_NONE) {
    ini_set('session.gc_maxlifetime', 86400); // 24 часа
    session_set_cookie_params(86400);
    session_start();
    if (!isset($_SESSION['cart_created'])) {
        $_SESSION['cart_created'] = time();
    }

    // Проверка времени жизни корзины (опционально)
    $cart_max_lifetime = 7 * 86400; // 7 дней
    if (time() - $_SESSION['cart_created'] > $cart_max_lifetime) {
        $_SESSION['cart'] = [];
        $_SESSION['cart_created'] = time();
    }
}

// Установим заголовки JSON
header('Content-Type: application/json; charset=utf-8');

// Простая обработка CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Получим action
$action = $_POST['action'] ?? '';

// Инициализируем корзину если не существует
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$response = [];

try {
    switch ($action) {
        case 'add_to_cart':
            $product = [
                'id' => intval($_POST['product_id']),
                'title' => $_POST['product_title'] ?? '',
                'price' => floatval($_POST['product_price']),
                'image' => $_POST['product_image'] ?? '',
                'quantity' => 1
            ];

            // Проверяем, есть ли уже такой товар
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $product['id']) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                if (count($_SESSION['cart']) < 50) { // Максимум 50 разных товаров
                    $_SESSION['cart'][] = $product;
                } else {
                    $response = [
                        'success' => false,
                        'error' => 'В корзине слишком много товаров'
                    ];
                    break;
                }
            }

            $response = [
                'success' => true,
                'cart_count' => count($_SESSION['cart']),
                'message' => 'Товар добавлен в корзину'
            ];
            break;

        case 'get_cart':
            $response = $_SESSION['cart'];
            break;

        case 'update_cart':
            $index = intval($_POST['index']);
            $quantity = intval($_POST['quantity']);

            if (isset($_SESSION['cart'][$index])) {
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$index]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                } else {
                    $_SESSION['cart'][$index]['quantity'] = $quantity;
                }
            }

            $response = [
                'success' => true,
                'cart_count' => count($_SESSION['cart'])
            ];
            break;

        case 'clear_cart':
            $_SESSION['cart'] = [];
            $response = ['success' => true];
            break;

        default:
            $response = [
                'success' => false,
                'error' => 'Unknown action'
            ];
            break;
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
}

// Всегда возвращаем валидный JSON
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
