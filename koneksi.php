<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ujikom_kasir";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$database = new Database("localhost","root", "", "ujikom_kasir");
$koneksi = $database->getConnection();
?>
