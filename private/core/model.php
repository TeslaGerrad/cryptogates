<?php
    // skyedu min's main Model
    class Model extends Database {
        public $errors = array ();

        public function __construct() {
            if(!property_exists($this, 'table')){
                $this->table = strtolower($this::class) . "s";
            }
        }

        public function where($columnName, $value) {
            $columnName = addslashes($columnName);
            $query = "SELECT * FROM $this->table WHERE $columnName = :value";
            $data = $this->query($query, array(
                'value'  => $value,
            ));

            // run these functions After Select
            if (is_array($data)) {
                if (property_exists($this, 'afterSelect')) {
                    foreach($this->afterSelect as $func) {
                        $data = $this->$func($data);
                    }
                }
            }

            return $data;
        }
        public function describe() {
            
            $query = "DESCRIBE $this->table";
            // show($query);die;
            return $this->query($query);
        }

        public function findAll() {
            $query = "SELECT * FROM $this->table";
            $data =  $this->query($query);
            
            // run these functions After Select
            if (is_array($data)) {
                if (property_exists($this, 'afterSelect')) {
                    foreach($this->afterSelect as $func) {
                        $data = $this->$func($data);
                    }
                }
            }

            return $data;

        }

        public function checkUniqueness($row, $value) {
            $query = "SELECT * FROM $this->table";
            $results = $this->query($query);
            $check_val = true;
            if (!empty($results) && is_array($results)) {
                foreach ($results as $compare) {
                    if ($compare->$row === $value) {
                        $check_val =  false;
                    }
                }
            }

            return $check_val;
        }

        public function is_equal ($check_val, $check_val_2) {
            if ($check_val === $check_val_2) {
                return true;
            }

            return false;
        }

        public function insert($data){
            // remove unwanted columns
            if(property_exists($this, 'allowed_columns')) {
                foreach($data as $key => $column) {
                    if(!in_array($key, $this->allowed_columns)) {
                        unset($data[$key]);
                    }
                }
            }

            // run these functions before unset
            if(property_exists($this, 'beforeInsert')) {
                foreach($this->beforeInsert as $func) {
                    $data = $this->$func($data);
                }
            }

            $keys = array_keys($data);
            // show($data);die;
            $columns  = implode(',', $keys);
            $values  = implode(',:', $keys);
            $values = ":" .$values;
            $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
            // show($query);die;
            return $this->query($query, $data);
        }

        public function update($id, $data){
            $str = "";
            foreach($data as $key => $value){
                $str .= $key . " = :" . $key . " ,";
            }

            $str = trim($str, ",");
            $query = "UPDATE $this->table SET $str WHERE `id` = :id";
            $data['id'] = $id;
            
            return $this->query($query, $data);
        }

        public function delete($id){
            $data['id'] = $id;
            $query = "DELETE FROM $this->table WHERE `id` = :id";
            
            return $this->query($query, $data);
        }

        public function generate_ID($MaxLength) {
            $array_of_charactors = array(1,2,3,4,5,6,7,8,9,0,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','*','+','-','_','@','!','&');
	
            $text = "";
            $length = rand(4, $MaxLength);

            for($i = 0; $i < $length; $i++){
                $newRandomCharectors = rand(0, $MaxLength);
                $text .= $array_of_charactors[$newRandomCharectors];
            }

            return $text;
        }
    }