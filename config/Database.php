<?php
    class Database {
        // DB Params
        private $host = '54.163.108.123';
        private $db_name = 'camagru';
        private $username = 'root';
        private $password = 'Root1234@';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null; 
            try {
                $this->conn = new PDO('mysql:host=54.163.108.123' . ';port=3306' . ';dbname=' . $this->db_name,
                // $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }


            return $this->conn;
        }

    }

?>
