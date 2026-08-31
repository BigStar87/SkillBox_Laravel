<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form employee</title>
</head>
<body>
<form name="employee-form" id="employee-form" method="post" action="{{ route('store-form') }}">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea type="text" id="address" name="address" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="work_data">WorkData</label>
        <textarea type="text" id="work_data" name="work_data" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
