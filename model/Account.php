<?php
    require_once 'Database.php';

    class Account {

        private $username;
        private $password;

        private $info;

        public function __construct($user,$pass) {
            $this->username = $user;
            $this->password = $pass;


        }

        public function GetID() {
            return $this->info['ID'];
        }

        public function __call($name, $arg) {
            if (isset($this->info)) {
                $name = strtoupper($name);

                if ($name != 'PASSWORD') {
                    if (isset($this->info[$name])) {
                        return $this->info[$name];
                    }
                    else return false;
                }
            }
            else return false;
        }

        public function Verify():bool {
            if (!isset($this->info)) {
                $db = new Database();

                $user = $this->username;
                $pass = $this->password;

                $query_result = $db->Query("SELECT * FROM ACCOUNT WHERE ACCOUNT.USERNAME = '$user' AND ACCOUNT.PASSWORD = '$pass'");

                //var_dump($query_result);
                if ($query_result->num_rows > 0) {
                    $this->info = $query_result->fetch_assoc();
                
                    return true; 
                }
                else return false;
            }
            else return true;
        }
    }
?>