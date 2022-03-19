<?php 
    class Signup extends Controller {
        public function index() {
            // getting registration data for the endpoint
            // show(json_encode($_SERVER['REQUEST_METHOD']));
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // instantiaing the user class and creating the user object
                $user = new user;
                // show($_POST);die;
                // validating the user object
                $validated_info = $user->is_user_valide ($_POST);

                // checking for error during validation
                if ($validated_info === true) {
                    // if there are no error create the User
                    $user->insert($_POST);
                    // success Massage
                    $this->redirect("login");die;
                }else {
                    $data['errors'] = $validated_info;

                }
            }
            
            $this->view("signup");die;
        }
    }