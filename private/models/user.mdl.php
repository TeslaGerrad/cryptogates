<?php 
    class User extends Model {
        protected $allowed_columns = [
            "user_id",
            "user_name",
            "first_name",
            "last name",
            "email",
            "password",
            "gender",
            "image",
            "reg_date"
        ];

        // list of functions before insertion
        protected $beforeInsert = [
            "make_user_id",
        ];
        
        protected function make_user_id($data) {
            $data['user_id'] = $this->generate_ID(60);
            unset($_SESSION['created_user_id']);
            $_SESSION['created_user_id'] = $data['user_id'];
            return $data;
        }
        public function is_user_valide ($DATA) {
            // turning array Data into An Object
            $DATA = (object)$DATA;

            // unseting the Errors Array incase there is any data in them and then setting it false
            unset($this->errors);
            $this->errors = false;
            
            // validations
            if (empty($DATA->user_name)) {
                $this->errors['user_name'] = "Please Provid A Username!";
            }
            if (empty($DATA->email)) {
                $this->errors['email'] = "Please Provid A Email!";
            }
            if (empty($DATA->password)) {
                $this->errors['password'] = "Please Provid A Password!";
            }
            if (empty($DATA->password1)) {
                $this->errors['password1'] = "Please Provid A Confirmation Password!";
            }
            if (!$this->is_equal($DATA->password, $DATA->password1)) {
                $this->errors['password'] = "Passwords Dont Much!";
            }

            // check uniqueness of the email and username
            if(!$this->checkUniqueness('user_name', $DATA->user_name)) {
                $this->errors['user_name'] = "Username Is Already Teken!";
            }
            if(!$this->checkUniqueness('email', $DATA->email)) {
                $this->errors['email'] = "Email Is Already Teken!";
            }
            if (empty($DATA->email)) {
                $this->errors['email'] = "User Email Is Invalid!";
            }
            if (!filter_var($DATA->email, FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Please Provid A User Email!";
            }

            // return true if there are no errors
            if (empty($this->errors)) {
                return true;
            }

            // return the errors if there are errors
            return $this->errors;
        }
        public function v_login_user ($DATA) {
            // turning array Data into An Object
            $DATA = (object)$DATA;

            // unseting the Errors Array incase there is any data in them and then setting it false
            unset($this->errors);
            $this->errors = false;
            
            // validations
            if (empty($DATA->email)) {
                $this->errors['email'] = "User Email Is Invalid!";
            }
            if (!filter_var($DATA->email, FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Please Provid A User Email!";
            }
            
            // if everything went well 
            if (empty($this->errors)){
                
                return true;
            }

            // if something went wrong

            return $this->errors;
        }
    }