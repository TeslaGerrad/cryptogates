<?php
    // Main Controller
    class Controller {
        public function view($view, $data = array()) {
            extract($data);
            $_prefix_view__        = "../private/views/";
            $__ext                 = ".view.php";
            if(file_exists($_prefix_view__ . $view . $__ext)) {
                require($_prefix_view__ . $view . $__ext);
            }else {
                require($_prefix_view__ . "404" . $__ext);
            }
        }

        public function loadModel($ModelName) {
            $_prefix_model__        = "../private/models/";
            $__ext                 = ".mdl.php";
            if(file_exists($_prefix_model__ . ucfirst($ModelName) . $__ext)) {
                require($_prefix_model__ . ucfirst($ModelName) . $__ext);
                return new $ModelName();
            }
            return false;
        }
        public function redirect($to) {
            header("Location: " . ROOT . $to);
            die;
        }
    }