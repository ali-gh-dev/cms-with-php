<?php

require "includes/init.php";


$database = new Database();
$db = $database->connect();
$article = new Article($db);

$articles = $article->read();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت مقالات</title>
</head>
<body>

    <div>
        <?php
        if (isset($_SESSION['is_logged_in'])) {
            echo "<button class='btn'><a href='logout.php'>Logout</a></button>";
        }else{
            echo "<button class='btn'><a href='login.php'>Login</a></button>";
        }
        ?>
    </div>

    <h1>لیست مقالات</h1>

    <a href="create.php">ایجاد مقاله جدید</a>
    <br>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th>عنوان</th>
                <th>تاریخ ایجاد</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $articles->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">ویرایش</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>">حذف</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>