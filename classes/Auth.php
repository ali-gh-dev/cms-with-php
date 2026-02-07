<?php



class Auth {
    public static function is_logged_in() {
        if (isset($_SESSION['is_logged_in'])) {
            return true;
        }
        return false;
    }

    public static function auth_attempt($conn, $user, $pass) {

        $query = "select * from user where username = :u";
        $result = $conn->prepare($query);
        $result->bindParam(':u', $user);
        $result->execute();
        $row = $result->fetch();


        if ($row) {
            // function for hashing password => password_hash('test-password', PASSWORD_DEFAULT)

            // comparison between hashed password in database & entered password
            // $pass => entered password
            // $row['password'] => hashed password in database
            $password_is_true = password_verify($pass, $row['password']);

            if ($password_is_true) {
                return true;
            }

        }

        return false;

    }

    public static function login() {
        $_SESSION['is_logged_in'] = true;
        echo "you logged in successfully !!!<br><br>";
        echo "<button class='btn'><a href='index.php'>Home</a></button>";
    }

    public static function logout() {
        session_destroy();
        echo "you logged out successfully !!!<br><br>";
        echo "<button class='btn'><a href='index.php'>Home</a></button>";
    }
}
