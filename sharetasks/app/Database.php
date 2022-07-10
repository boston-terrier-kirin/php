<?php
class Database {
    private $conn;
    private $stmt;
    private $params = [];
    private $rawSql;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    private function getConnection() {
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASS;

        $dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            $db = new PDO($dsn, $db_user, $db_pass, $options);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function beginTransaction() {
        $this->conn->beginTransaction();
    }

    public function commit() {
        $this->conn->commit();
    }

    public function rollback() {
        $this->conn->rollback();
    }

    public function prepare($sql) {
        $this->rawSql = $sql;
        $this->stmt = $this->conn->prepare($sql);
    }

    public function bindValue($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) || empty($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->params[$param] = $value;
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        $start = microtime(true);
        $result = $this->stmt->execute();
        $end = microtime(true);
        
        if (SQL_TRACE) {
            $log = [
                "user" => Auth::getUser(),
                "exec_time" => $end - $start,
                "sql" => $this->getSql()
            ];
            error_log(json_encode($log) . "\r\n", 3, SQL_TRACE_FILE);
        }
        
        return $result;
    }

    public function fetch() {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }

    public function getSql() {
        $keys = array();
        $values = array();

        foreach ($this->params as $key => $value) {
            if (is_string($value)) {
                $values[] = "'" . addslashes($value) . "'";
            } elseif(is_int($value)) {
                $values[] = strval($value);
            } elseif (is_float($value)) {
                $values[] = strval($value);
            } elseif (is_null($value)) {
                $values[] = 'NULL';
            }

            if (is_string($key)) {
                $keys[] = '/:'.ltrim($key, ':').'/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $this->params = [];

        return preg_replace($keys, $values, $this->rawSql);
    }
}
