<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Employee</title>
</head>
<body>
<h2>Edit Employee: {{ $employee->name }}</h2>

<form name="employee-edit-form" id="employee-edit-form" method="post" action="{{ route('update-form', $employee->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $employee->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $employee->email }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" class="form-control" value="{{ $employee->address }}">
    </div>
    <div class="form-group">
        <label for="work_data">Work Data</label>
        <textarea id="work_data" name="work_data" class="form-control">{{ $employee->work_data }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</body>
</html>
