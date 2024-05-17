<?php

class DB {
    private $host = 'localhost'; // MySQL server host
    private $user = 'username'; // MySQL username
    private $password = 'password'; // MySQL password
    private $database = 'dbname'; // MySQL database name
    private $conn;

    // Constructor - connect to the database
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Function to execute SQL queries
    public function executeQuery($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result;
    }

    // Function to insert data into a table
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $this->executeQuery($sql);
    }

    // Function to fetch a single row from a table
    public function selectOne($table, $condition) {
        $sql = "SELECT * FROM $table WHERE $condition LIMIT 1";
        $result = $this->executeQuery($sql);
        return $result->fetch_assoc();
    }

    // Function to close the database connection
    public function close() {
        $this->conn->close();
    }
}

?>
