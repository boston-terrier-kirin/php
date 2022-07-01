<?php
require_once("Database.php");
require_once("../model/Response.php");
require_once("../model/Task.php");

try {
    $conn = Database::getConnection();
} catch (PDOException $e) {
    error_log("Database connection error: " . $ex, 0);

    $res = new Response();
    $res->setHttpStatusCode(500);
    $res->setSuccess(false);
    $res->addMessage("Database connection error");
    $res->send();
    exit;
}

if (isset($_GET["taskId"])) {
    $taskId = $_GET["taskId"];

    if ($taskId === "" || !is_numeric($taskId)) {
        $res = new Response();
        $res->setHttpStatusCode(400);
        $res->setSuccess(false);
        $res->addMessage("Invalid taskId");
        $res->send();
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // http://localhost:8090/basic_api/tasks/4
        try {
            $sql = "select *
                      from tasks
                     where id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $taskId, PDO::PARAM_INT);
            $stmt->execute();

            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                $res = new Response();
                $res->setHttpStatusCode(404);
                $res->setSuccess(false);
                $res->addMessage("Task not found");
                $res->send();
                exit;
            }

            $tasks = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $task = new Task($row["id"], $row["title"], $row["description"], $row["deadline"], $row["completed"]);
                $tasks[] = $task->returnTaskAsArray();
            }

            $returnData = [];
            $returnData["rows_returned"] = $rowCount;
            $returnData["tasks"] = $tasks;

            $res = new Response();
            $res->setHttpStatusCode(200);
            $res->setSuccess(true);
            $res->setData($returnData);
            $res->send();
            exit;

        } catch(PDOException $e) {
            error_log("GET Task error: " . $ex, 0);

            $res = new Response();
            $res->setHttpStatusCode(500);
            $res->setSuccess(false);
            $res->addMessage("GET Task error");
            $res->send();
            exit;
        }

    } elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
        // http://localhost:8090/basic_api/tasks/4
        try {
            $sql = "delete
                      from tasks
                     where id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $taskId, PDO::PARAM_INT);
            $stmt->execute();

            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                $res = new Response();
                $res->setHttpStatusCode(404);
                $res->setSuccess(false);
                $res->addMessage("Task not found");
                $res->send();
                exit;
            }

            $res = new Response();
            $res->setHttpStatusCode(200);
            $res->setSuccess(true);
            $res->send();
            exit;

        } catch(PDOException $e) {
            error_log("DELETE Task error: " . $ex, 0);

            $res = new Response();
            $res->setHttpStatusCode(500);
            $res->setSuccess(false);
            $res->addMessage("GET Task error");
            $res->send();
            exit;
        }
    } elseif ($_SERVER["REQUEST_METHOD"] === "PATCH") {
    
    } else {
        $res = new Response();
        $res->setHttpStatusCode(405);
        $res->setSuccess(false);
        $res->addMessage("Request method not allowed");
        $res->send();
        exit;
    }
}

?>