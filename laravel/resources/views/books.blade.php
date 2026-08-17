<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User registration</title>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <table>
                @foreach($books as $key => $book)
                    <tr>
                        <td>{{ $book }}</td>
                        <td><a href="{{ route('remove_book', $key) }}">REMOVE</a></td>
                    </tr>
                @endforeach
                </table>
                <form name="add-new-book" id="add-new-book" method="post" action="{{ route('save_book') }}">
                    @csrf
                    <div class="form-group">
                        <label for="book_name">Name book</label>
                        <input type="text" id="book_name" name="book_name" class="form-control" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
