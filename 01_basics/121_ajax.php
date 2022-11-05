<?php
$currentPage = $_SERVER["PHP_SELF"];
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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mb-0 h1" href="<?= $currentPage ?>">Golden State Warriors</a>
        </div>
    </nav>

    <div class="container p-3">
        <form action="<?= $currentPage ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Search Players</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <p>Suggestions: <span id="output"></span></p>
            </div>
        </form>
    </div>

    <script>
        document.querySelector("#name").addEventListener("keyup", async (e) => {
            const query = e.target.value;
            if (query.length === 0) {
                document.querySelector("#output").innerHTML = "";
                return;
            }

            const res = await fetch(`122_ajax_suggest.php?q=${query}`);
            const data = await res.json();

            document.querySelector("#output").innerHTML = data;
        })
    </script>
</body>
</html>