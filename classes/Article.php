<?php
class Article {
    private $conn;
    private $table = 'articles';

    public function __construct($db) {
        $this->conn = $db;
    }

    // ایجاد مقاله
    public function create($title, $content) {
        $query = "INSERT INTO " . $this->table . " (title, content) VALUES (:title, :content)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // دریافت تمام مقالات
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // دریافت مقالات یک صفحه
    public function get_page($limit, $offset) {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // دریافت یک مقاله بر اساس ID
    public function read_single($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // ویرایش مقاله
    public function update($id, $title, $content) {
        $query = "UPDATE " . $this->table . " SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // حذف مقاله
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>