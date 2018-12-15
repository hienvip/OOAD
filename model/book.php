<?php
    require_once 'Database.php';

    function GetCode($bookID,$userID):string {
        $code = $bookID.'borrow'.$userID;

        return convert_uuencode($code);
    }

    class Book {

        private $id;
        private $info;

        public function __construct($_id) {
            $this->id = $_id;
            $this->Exist();
        }

        public function Exist():bool {
            if (!isset($this->info)) {
                $db = new Database();

                $id = $this->id;
                $result = $db->Query("SELECT * FROM BOOKINFO WHERE BOOKINFO.ID = '$id'");

                if ($result->num_rows > 0) {
                    $this->info = $result->fetch_assoc();
                    return true;
                }
                return false;
            }

            return true;
        }

        public function __call($name,$args) {
            $name = strtoupper($name);
            if (isset($this->info[$name])) {
                return $this->info[$name];
            }
        }

        public function GetID() {
            return $this->info['ID'];
        }

        public function Borrow($userId):bool {
            if ($this->Exist()) {
                $bookId = $this->id;
                $accId = $userId;
                $code = GetCode($bookId, $accId);

                $db = new Database();
                $sql = "INSERT INTO BORROWEDBOOK (ACCID,CODE,BOOKID) VALUES ('$accId','$accId','$bookId')";

                if ($db->Query($sql)) {
                    return true;
                }
                
                return false;
            }
            return false;
        }
    }

    // $a = new Book('1');

    // echo $a->Borrow('1');
?>