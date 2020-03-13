<?php
    class Database {
        // DB Params

        private $host = 'localhost';
        private $db_name = 'camagru';
        private $username = 'root';
        private $password = 'root1234@';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, 
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }

?>













<?php

    // $host = 'localhost';
    // $user = 'root';
    // $password = 'root1234@';
    // $dbname = 'camagru';

    // // Set DSN
    // $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // // Create a PDO instance
    // try {
    //      $pdo = new PDO($dsn, $user, $password);
    //      // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    //      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // }
    // catch (PDOException $e) {
    //     echo 'Connection Error: ' . $e->getMessage();
    // }
    
?>