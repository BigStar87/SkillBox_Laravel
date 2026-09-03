<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>employee validation</title>
</head>
<style>
    .invalid {border-color: red;}
</style>
<body>
<form action="{{ route('post_validation_form') }}" method="post">
    @csrf
    <div class="group_form">
        <lable>Name</lable>
        <input type="text" @error('name') class="invalid" @enderror name="name">
    </div>
    <div class="group_form">
        <lable>Password</lable>
        <input type="password" name="password">
    </div>
    <div class="group_form">
        <lable>Confirm password</lable>
        <input type="password" name="confirmpassword">
    </div>
    <button type="submit">Submit</button>
</form>
@foreach($errors->all() as $error)
    {{ $error }} <br>
@endforeach
</body>
</html>
