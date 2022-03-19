<?php
    class Database{
        private function connect() {
            // making Database Connection
            try{
                $stm = DBDRIVER . ":host=" . SERVERHOST . ";dbname=" . DATABASE; 
                $con = new PDO($stm, DBUSER, DBPASSWORD); 
            }catch (PDOException $e){
                show($e->getMessage());
                die;
            }

            return $con;
        }

        public function query($query, $data = array(), $data_type = "object") {
            $connection = $this->connect();
            $statement  = $connection->prepare($query);
            if($statement) {
                $check  = $statement->execute($data);
                if($check) {
                    if($data_type === "object") {
                        $return_data = $statement->fetchAll(PDO::FETCH_OBJ);
                    }else{
                        $return_data = $statement->fetchAll(PDO::FETCH_ASSOC);
                    }
                    if(is_array($return_data) && count($return_data) > 0) {
                        return $return_data;
                    }
                }
            }
            return false;
        }



    }
