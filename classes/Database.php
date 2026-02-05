<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'cms';
    private $username = 'root'; // تغییر دهید به نام کاربری دیتابیس خود
    private $password = ''; // تغییر دهید به رمز عبور دیتابیس خود
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>