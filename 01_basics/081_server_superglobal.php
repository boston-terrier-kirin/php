<?php
// $_SERVER SUPERGLOBAL
$server = [
   "Host Server Name" => $_SERVER["SERVER_NAME"],
   "Host Header" => $_SERVER["HTTP_HOST"],
   "Server Software" => $_SERVER["SERVER_SOFTWARE"],
   "Document Root" => $_SERVER["DOCUMENT_ROOT"],
   "Current Page" => $_SERVER["PHP_SELF"],
   "Script Name" => $_SERVER["SCRIPT_NAME"],
   "Absolute Path" => $_SERVER["SCRIPT_FILENAME"],
];

$client = [
    "Client System Info" => $_SERVER["HTTP_USER_AGENT"],
    "Client IP" => $_SERVER["REMOTE_ADDR"],
    "Remote Port" => $_SERVER["REMOTE_PORT"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>System Info</title>
</head>
<body>
    <div class="container">
        <h1>Server & File Info</h1>
        <?php if ($server): ?>
            <ul class="list-group mb-3">
                <?php foreach($server as $key => $value): ?>
                    <li class="list-group-item">
                        <strong><?= $key ?>: </strong>
                        <?= $value ?> 
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif; ?>

        <h1>Client Info</h1>
        <?php if ($client): ?>
            <ul class="list-group">
                <?php foreach($client as $key => $value): ?>
                    <li class="list-group-item">
                        <strong><?= $key ?>: </strong>
                        <?= $value ?> 
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>