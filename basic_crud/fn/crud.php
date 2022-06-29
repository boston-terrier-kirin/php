<?php include "db.php"; ?>

<?php
    function getUsers() {
        global $conn;

        $query = 'select * from users';
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die('Query failed: ' . mysqli_error());
        }

        return $result;
    }

    function createUser($username, $password) {
        global $conn;
      
        $query = 'insert into users(username, password) ';
        $query .= "values('$username', '$password')";
      
        $result = mysqli_query($conn, $query);
      
        if (!$result) {
          die('Query failed: ' . mysqli_error());
        }
    }

    function showIds() {
        global $conn;
        
        $query = "select * from users";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error());
        }

        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            echo "<option value='$id'>$id</option>";
        }
    }

    function updateTable($id, $username, $password) {
        global $conn;

        $query = "update users set username = '$username', password = '$password' ";
        $query .= "where id = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error());
        }
    }

    function deleteTable($id) {
        global $conn;

        $query = "delete from users ";
        $query .= "where id = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error());
        }
    }
?>