<?php
    // main App 
    // My Resume App
    class App {
        protected $controller        = "users";
        protected $method            = "index";
        protected $params            = array();

        public function __construct(){
            $_prefixController__     = "../private/controllers/";
            $__ext                   = ".php";
            $URL                     = $this->getURL();
            if(file_exists($_prefixController__ . $URL[0] . $__ext)) {
                $this->controller    = ucfirst($URL[0]);
                unset($URL[0]);
            }

            // requiring the File
            require($_prefixController__ . $this->controller . $__ext);

            // instanciating the Controller Class
            $this->controller        = new $this->controller();

            // methods
            if(isset($URL[1])){
                if(method_exists($this->controller, $URL[1])) {
                    // getting the method From the Controller Class
                    $this->method   = ucfirst($URL[1]);
                    unset($URL[1]);
                }
            }

            $URL                    = array_values($URL);
            $this->params           = $URL;
            call_user_func_array([$this->controller, $this->method], $this->params);


        }

        private function getURL(){
            $url                    = (isset($_GET['url'])) ? $_GET['url'] : "home"; 
            return explode("/", filter_var(trim($url, "/")), FILTER_VALIDATE_URL);
        }
    }
    