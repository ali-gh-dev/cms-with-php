<?php
session_start();
require "includes/init.php";

if (!Auth::is_logged_in()) {
    echo "you don't allow to create article.<br><br>login first !!!<br><br>";
    echo "<button class='btn'><a href='login.php'>Login</a></button>";
    die();
}

$database = new Database();
$db = $database->connect();
$article = new Article($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    if ($article->create($title, $content)) {
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد مقاله</title>
</head>
<body>

    <h1>ایجاد مقاله جدید</h1>

    <form method="POST">
        <label for="title">عنوان:</label><br>
        <input type="text" name="title" required><br><br>

        <label for="content">محتوا:</label><br>
        <textarea name="content" rows="5" required></textarea><br><br>

        <input type="submit" value="ایجاد مقاله">
    </form>

</body>
</html>