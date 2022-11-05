<?php
class User {
    public static function getAll($conn) {
        $sql = "select *
                  from users";

        $results = $conn->query($sql);
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>