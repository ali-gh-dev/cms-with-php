<?php
session_start();
require "includes/init.php";

if (!Auth::is_logged_in()) {
    echo "you don't allow to delete article.<br><br>login first !!!<br><br>";
    echo "<button class='btn'><a href='login.php'>Login</a></button>";
    die();
}

$database = new Database();
$db = $database->connect();
$article = new Article($db);

$id = $_GET['id'];
if ($article->delete($id)) {
    header('Location: index.php');
}
?>