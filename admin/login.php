<?php

require "../includes/init.php";
require "../includes/connection.php";


if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $auth_result = Auth::auth_attempt($conn, $user, $pass);

    if ($auth_result) {
        Auth::login();
    }else{
        echo "oops. wrong data ...";
    }

    die();

}

?>

<form action="" method="post">
    <label for="">username : </label>
    <input type="text" name="username" required>
    <br>
    <label for="">password : </label>
    <input type="password" name="password" required>
    <br>
    <button class="btn" type="submit">Login</button>
</form>