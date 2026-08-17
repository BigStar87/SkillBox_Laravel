<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
</head>
<body>
    <h2>Table employees</h2>
    <form method="post" action="{{ route('save_employees') }}">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="name">
        <input type="text" name="email" class="form-control" placeholder="email">
        <button type="submit" class="btn btn-primary">Success</button>
    </form>
</body>
</html>
