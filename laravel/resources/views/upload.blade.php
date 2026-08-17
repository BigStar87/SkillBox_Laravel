<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>File upload</title>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form name="add-new-file" id="add-new-file" enctype="multipart/form-data" method="post" action="{{ route('upload_file') }}">
                    @csrf
                    <div class="form-group">
                        <label for="file_name">file name</label>
                        <input type="text" id="file_name" name="file_name" class="form-control" required="">
                        <input type="file" name="uploaded_file">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
