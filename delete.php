<?php
include_once './classes/Database.php';
include_once './classes/Article.php';

$database = new Database();
$db = $database->connect();
$article = new Article($db);

$id = $_GET['id'];
if ($article->delete($id)) {
    header('Location: index.php');
}
?>