<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Book</title>
</head>
<style>
    .alert-danger {color: red}
</style>
<body>
<form action="{{ Route('store-form') }}" method="post">
    @csrf
    <div class="form-section">
        <lable for="title">Title</lable>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>
    <div class="form-section">
        <lable for="author">Author</lable>
        <input type="text" id="author" name="author" class="form-control" required>
    </div>
    <div class="form-section">
        <lable for="genre">Choose Genre:</lable>
        <select id="genre" name="genre">
            <option value="fantasy">Fantasy</option>
            <option value="sci-fi">Sci-fi</option>
            <option value="mystery">Mystery</option>
            <option value="drama">Drama</option>
        </select>
    </div>
    <div class="form-section">
        <lable for="story">Story</lable>
        <textarea id="story" name="story" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
