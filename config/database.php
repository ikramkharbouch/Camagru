<?php    
    class Database {
        // DB Params
        private $host = 'localhost';
        private $db_name = 'ikrkharb';
        private $username = 'root';
        private $password = 'JJ2AhRBcqFjtxJ';
        private $conn;

        // DB Connect
        
        public function connect() {
            $this->conn = null; 
            try {
                $this->conn = new PDO('mysql:host=localhost' . ';port=3306' . ';dbname=' . $this->db_name,
                // $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                session_start();
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
