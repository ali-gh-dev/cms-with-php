<?php
session_start();
require "includes/init.php";

$database = new Database();
$db = $database->connect();
$article = new Article($db);

$id = $_GET['id'];
$articleData = $article->read_single($id)->fetch(PDO::FETCH_ASSOC);

if (!$articleData) {
    die('چنین مقاله ای یافت نشد ...');
}

?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محتوای مقاله</title>
</head>
<body>

    <h2><?php echo $articleData['title'] ?></h2>
    <p><?php echo $articleData['content'] ?></p>

    <button type="button" class="btn">
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">بازگشت</a>
    </button>

    
</body>
</html>