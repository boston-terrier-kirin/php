<?php
class TaskController {
    private $taskGateway;

    public function __construct($taskGateway) {
        $this->taskGateway = $taskGateway;
    }

    public function processRequest($method, $id) {
        if ($id == null) {
            if ($method == "GET") {
                echo json_encode($this->taskGateway->getAll());
            } elseif ($method == "POST") {
                $data = (array) json_decode(file_get_contents("php://input"), true);
                if ($data) {
                    http_response_code(201);
                    echo json_encode([
                        "id" => $this->taskGateway->create($data)
                    ]);
                } else {
                    http_response_code(400);
                }
            } else {
                http_response_code(405);
                header("Allow: GET, POST");
            }
        } else {
            $data = $this->taskGateway->get($id);
            if (!$data) {
                http_response_code(404);
                echo json_encode([
                    "message" => "Task not found"
                ]);
                return;
            }

            if ($method == "GET") {
                echo json_encode($data);
            } elseif ($method == "PATCH") {
                $data = (array) json_decode(file_get_contents("php://input"), true);
                if ($data) {
                    echo json_encode([
                        "rows_updated" => $this->taskGateway->update($id, $data)
                    ]);
                } else {
                    http_response_code(400);
                }
            } elseif ($method == "DELETE") {
                echo json_encode([
                    "rows_deleted" => $this->taskGateway->delete($id)
                ]);
            } else {
                http_response_code(405);
                header("Allow: GET, PATCH, DELETE");
            }
        }
    }
}