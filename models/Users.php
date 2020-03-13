<?php
    class Users {
        // DB stuff
        private $conn;
        private $table = 'users';

        // Post Properties
        public $id;
        public $email;
        public $username;
        public $pass;
        public $verified;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Users
        public function read() {

            // Create query
            $query = 'SELECT id, email, username, pass FROM users';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single User
        public function read_single() {
             // Create query
             $query = 'SELECT
             id,
             email,
             username,
             pass
             FROM users 
             WHERE id = ?
             LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            // Fetch in associative array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->email = $row['email'];
            $this->username = $row['username'];
            $this->pass = $row['pass'];
            $this->verified = $row['verified'];
        }

        // Create User
        public function create() {
            // Create query
            $query = 'INSERT INTO users
            SET
                email = :email,
                username = :username,
                pass = :pass';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->pass = htmlspecialchars(strip_tags($this->pass));

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':pass', $this->pass);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }

        public function update() {
             // Create query
             $query = 'UPDATE users
             SET
                 email = :email,
                 username = :username,
                 pass = :pass
             WHERE
                id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->pass = htmlspecialchars(strip_tags($this->pass));

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':pass', $this->pass);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }
    }
?>