<?php
    class Auth extends Model {
        public static function authenticate ($row) {
            $_SESSION['USER'] = $row;
        }

        public static function logout () {
            if (isset ($_SESSION['USER'])) {
                unset ($_SESSION['USER']);
            }
        } 

        public static function is_loged_in () {
            if (isset ($_SESSION['USER'])) {
                return true;
            }

            return false;
        } 

        public static function user () {
            if (isset ($_SESSION['USER'])) {
                return $_SESSION['USER']->first_name;
            }
        }

        public static function __callStatic($method, $params) {
            $property = strtolower(str_replace("get", "", $method));
            if (isset ($_SESSION['USER'])) {
                return $_SESSION['USER']->$property;
            }

            return "Unknow";
        }
    }
    