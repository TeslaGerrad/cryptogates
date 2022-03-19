<?php 
    class Logout extends Controller {
        public function index () {
            Auth::logout();
            
            $msg['status'] = 1;
            header("Content-type: Application/json");
            header("HTTP/1.1 200 OK");
            return $this->redirect("login");
            die;
        }
    }