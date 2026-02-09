<?php
session_start();
require "../includes/init.php";

if (!Auth::is_logged_in()) {
    echo "you are not allowed to edit article.<br><br>login first !!!<br><br>";
    echo "<button class='btn'><a href='login.php'>Login</a></button>";
    die();
}

$database = new Database();
$db = $database->connect();
$article = new Article($db);

$id = $_GET['id'];
$articleData = $article->read_single($id)->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (Auth::is_logged_in()) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        if ($article->update($id, $title, $content)) {
            header('Location: index.php');
        }
    }else {
        die("you don't allow to edit articles.<br>login first !!!");
    }
    
}

?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش مقاله</title>
</head>
<body>

    <h1>ویرایش مقاله</h1>

    <form method="POST">
        <label for="title">عنوان:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($articleData['title']); ?>" required><br><br>

        <label for="content">محتوا:</label><br>
        <textarea name="content" rows="5" required><?php echo htmlspecialchars($articleData['content']); ?></textarea><br><br>

        <input type="submit" value="ویرایش مقاله">
    </form>

</body>
</html>