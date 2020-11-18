<?php    
    class Database {
        // DB Params
        private $host = 'localhost';
        private $db_name = 'camagru';
        private $username = 'root';
        private $password = 'BmKf2xrFZFqaTM';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null; 
            try {
                $this->conn = new PDO('mysql:host=localhost' . ';port=3306' . ';dbname=' . $this->db_name,
                // $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
                echo $this->host;
                echo $this->db_name;
                echo $this->username;
                echo $this->password;
            }


            return $this->conn;
        }

    }

?>
