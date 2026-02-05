<?php

class Auth {
    public static function is_logged_in() {
        if (isset($_SESSION['is_logged_in'])) {
            return true;
        }
        return false;
    }
}
