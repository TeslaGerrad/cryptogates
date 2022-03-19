<?php
    // Home Controller
    class Users extends Controller {
        public function index() {
            if (!Auth::is_loged_in()) {
                
                $this->redirect("login");die;
            }
            $this->view("profile");
            
        }

        public function profile ($user_key) {
            if (!Auth::is_loged_in() || esc($user_key) != Auth::getUser_id()) {
                
                return $this->redirect("login");
                die;
            }

            $data['user_info'] = Auth::user();
            $this->view("profile"); 
            die;
        }
        public function delete_account ($user_key) {
            $user = new User();
            if (!Auth::is_loged_in() || esc($user_key) != Auth::getUser_id()) {
                
                $this->redirect("login");
                die;
            }

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                
                $data = $user->where('user_id', esc($user_key));
                if (is_array($data) && count ($data) > 0) {
                    $user->delete(esc($data[0]->id));
                    Auth::logout();
                    
                    $this->redirect("login");
                    die;
                }
                
            }

            $this->redirect("login");
            die;
        }

        public function update ($user_key) {
            if (!Auth::is_loged_in() || esc($user_key) != Auth::getUser_id()) {
                return $this->redirect("login");
                die;
            }
            $user = new User();

            // updating functions
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $validated_info = $user->is_user_valide($_POST);
                if ($validated_info === true) {
                    $user->update(esc($user_key), $_POST);
                    $data = $user->where('user_id', esc($user_key));
                    $this->redirect("profile");
                    die;
                }
            }

            // get the User
            $data = $user->where("user_id", esc($user_key));
            $this->redirect("edit_profile");
            die;
        }
    }