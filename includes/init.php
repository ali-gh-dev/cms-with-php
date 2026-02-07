<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  


spl_autoload_register(function($class){
    require "classes/" . $class . ".php";
});


?>