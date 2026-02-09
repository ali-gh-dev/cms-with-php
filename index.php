<?php

require "includes/init.php";


$database = new Database();
$db = $database->connect();
$article = new Article($db);

// $articles = $article->read();


$pagination = new Paginator($_GET['page'] ?? 1, 5, $article->get_count()['total']);
var_dump($pagination);

// articles of one page
$articles = $article->get_page($pagination->limit, $pagination->offset);




?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>مدیریت مقالات</title>
</head>
<body>

    <!-- login / logout button -->
    <div>
        <?php
        if (Auth::is_logged_in()) {
            echo "<button class='btn'><a href='logout.php'>Logout</a></button>";
        }else{
            echo "<button class='btn'><a href='login.php'>Login</a></button>";
        }
        ?>
    </div>

    <h1>لیست مقالات</h1>

    <table border="1">
        <thead>
            <tr>
                <th>عنوان</th>
                <th>متن مقاله</th>
                <th>تاریخ ایجاد</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $articles->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['content']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>