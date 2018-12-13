<?php
    class Database {
        private $connection;
        private $servername = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbName = 'library';

        public function __construct() {
            //$connection = new mysqli($servername, $username, $password);
        }

        public function Query($sql) {
            $connection = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
            $connection->set_charset('utf8');
            
            $result = $connection->Query($sql);
            var_dump($result);
            $connection->close();
            return $result;
        }
    }
?>