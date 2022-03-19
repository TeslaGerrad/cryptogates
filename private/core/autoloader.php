<?php
    // including all Neccesary Files
    include("config.php");
    include("functions.php");
    include("database.php");
    include("model.php");
    include("controller.php");
    include("app.php");

    // auto loading the clas when needed
    spl_autoload_register(function($className){
        $_prefix_model__        = "../private/models/";
            $__ext                 = ".mdl.php";
            if(file_exists($_prefix_model__ . ucfirst($className) . $__ext)) {
                require($_prefix_model__ . ucfirst($className) . $__ext);
            }
    });