<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
<table border="3px">
    @foreach($users as $key => $user)
        @if($key % 2 == 0)
            <tr>
                <td>{{ $key }}</td>
                <td style="background-color: gray">{{ $user }}</td>
            </tr>
        @else
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $user }}</td>
            </tr>
        @endif
    @endforeach
</table>
</body>
</html>
