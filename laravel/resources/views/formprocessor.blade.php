<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>User form</title>
</head>
<body>
<div class="container">
    <div class="form-header">
        <h2>User form</h2>
    </div>
    <div class="form-body">
        <form method="post" action="{{ route('store-user') }}">
            @csrf
            <div class="form-group">
                <label for="user_name">Name:</label>
                <input type="text" id="user_name" name="user_name" class="form-control" required><br><br>
                <label for="user_lastname">Lastname:</label>
                <input type="text" id="user_lastname" name="user_lastname" class="form-control" required><br><br>
                <label for="user_email">E-mail:</label>
                <input type="text" id="user_email" name="user_email" class="form-control" required>
            </div><br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
