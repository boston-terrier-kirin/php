<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div id="example-table"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>
    <script>
        // axios
        // async function getUsers() {
        //     const response = await axios.get('http://localhost:8090/basic_tabulator/get-user.php');
        //     const table = new Tabulator("#example-table", {
        //         data: response.data,
        //         autoColumns: true,
        //     });
        // }
        // getUsers();

        // jquery
        $(function() {
            $.ajax("get-user.php")
                .done(function(data){
                    const user = JSON.parse(data);
                    const table = new Tabulator("#example-table", {
                       data: user,
                       autoColumns: true,
                    });
                });
        });
    </script>
</body>
</html>