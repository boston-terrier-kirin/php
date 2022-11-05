<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <input type="text" id="id" />
    </div>
    <div>
        <input type="text" id="name" />
    </div>
    <div>
        <input type="text" id="email" />
    </div>
    <div>
        <input type="text" id="dob" />
    </div>

    <button id="btn">Click</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $("#btn").on("click", function() {
            $.ajax("gettime.php")
                .done(function(data){
                        const user = JSON.parse(data);

                        $("#id").val(user.id);
                        $("#name").val(user.name);
                        $("#email").val(user.email);
                        $("#dob").val(user.dob);
                    });
        });
    </script>
</body>
</html>