<?php

require "includes/init.php";


$database = new Database();
$db = $database->connect();
$article = new Article($db);

// all articles
// $articles = $article->read();


$pagination = new Paginator($_GET['page'] ?? 1, 5, $article->get_count()['total']);


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
                <th>id</th>
                <th>عنوان</th>
                <th>تاریخ ایجاد</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $articles->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><a href="view.php?id=<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br><br>

    <footer>
        <ul>
            <li>
                <?php
                    if (!$pagination->previous) {
                        echo "previous";
                    }else {
                        echo "<a href=?page=" . $pagination->previous . ">Previous</a>";
                    }
                 ?>
            </li>
            

            <li>
                <?php
                    if (!$pagination->next) {
                        echo "next";
                    }else {
                        echo "<a href=?page=" . $pagination->next . ">Next</a>";
                    }
                 ?>
            </li>
        </ul>
    </footer>

</body>
</html>