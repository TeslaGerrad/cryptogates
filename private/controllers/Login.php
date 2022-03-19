<?php
    class Login extends Controller {
        public function index () {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // user loggin the user
                // instantiaing the user class and creating the user object
                $user = new user;
                // validate Login
                $validate_user = $user->V_login_user($_POST);
                if ($validate_user === true) {
                    $data = $user->where('email', esc($_POST['email']));
                    
                    if (count ($data) > 0){
                        // show($data);die;
                        if ($user->is_equal($_POST['password'], $data[0]->password)){
                            // logging in user
                            Auth::authenticate($data[0]);
                            
                            $this->redirect("profile");die;
                        }
                    }
                    
                    $data['errors'] = "Wrong Email Or Password"; 
                } 
                // if something went wrong
                $data['errors'] = $validate_user;              

            }

            
            $this->view("login");die;

        }
    } 