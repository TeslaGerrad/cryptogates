<?php
    session_start();
    // session_destroy();
    
    $link = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
    $link = str_replace("index.php", "", $link); 
    define('ROOT', $link);
    define('ASSETS', $link . 'assets/');

    // app entry point
    $_prefix__ = "../private/core/";
    include($_prefix__ . "autoloader.php");
    
    // initializing the Application
    $app = new App();
    