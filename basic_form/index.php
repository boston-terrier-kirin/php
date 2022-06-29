<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea class="form-control" name="comment" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <!-- 複数選択の場合、cars[] にする -->
                <select class="form-select" name="cars[]" multiple>
                    <option value="bmw">BMW</option>
                    <option value="fmc">Ford</option>
                    <option value="saab">Saab</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="yes" name="agree">
                    <label class="form-check-label" for="agree">同意</label>
                </div>
            </div>
            <div class="mb-3">
                <!-- チェックボックスをグルーピングする場合はcolors[] にする -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="colors[]" value="red">
                    <label class="form-check-label" for="agree">Red</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="colors[]" value="green">
                    <label class="form-check-label" for="agree">Green</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="colors[]" value="blue">
                    <label class="form-check-label" for="agree">Blue</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Default radio
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Second default radio
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>