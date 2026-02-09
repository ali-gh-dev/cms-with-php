<?php

class Url {
    public static function redirect($path) {
        
        if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] !== 'off') {
            $protocol = 'https';
        }else{
            $protocol = 'http';
        }

        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/cms-with-php/admin" . $path);
        exit;

    }
}
