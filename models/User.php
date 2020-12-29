<?php

    class User {
        // DB stuff
        private $conn;
        private $table = 'users';

        // User Properties
        public $id;
        public $email;
        public $username;
        public $pass;
        public $verified;
        public $base64;
        public $path_to_img;
        public $filter;
        public $offset;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Users
        public function read() {
            // Create query
            $query = 'SELECT id, email, username, pass, verified
            FROM users';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single user
    public function read_single() {
        // Create query
        $query = 'SELECT id, email, username, pass, verified
                  FROM users
                  WHERE id = ?
                  LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->email = $row['email'];
        $this->username = $row['username'];
        $this->pass = $row['pass'];
        $this->verified = $row['verified'];
    }

    // Create new user
    public function create() {
        // Create Query
       $query = 'INSERT INTO users SET email = :email, username = :username, pass = :pass, verified = :verified, token = :token;';

    //    $query = 'BEGIN;
    //     INSERT INTO users SET email = :email, username = :username, pass = :pass, verified = :verified, token = :token;
    //     INSERT INTO posts SET user_id = mysql_insert_id();
    //    COMMIT;';

    //    $query = "INSERT INTO users (email, username, pass, verified, token) VALUES ('test@test.fr', 'tester21', 'test@hh1423', '0', 'hdhufgeiuf')";

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pass = htmlspecialchars(strip_tags($this->pass));
        $this->verified = 0;
        $this->token = htmlspecialchars($this->token);

        //Check if data is empty
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (!filter_var($this->username, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-z-A-Z]+/")))) {
            return false;
        }
        if (!filter_var($this->pass, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-z-A-Z]+[0-9]+/")))) {
            return false;
        }

        // if(!($stmt->bind_param(':email', $this->email))){
        //     die( "Error in bind_param: (" .$this->conn->errno . ") " . $this->conn->error);
        // }

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':pass', $this->pass); 
        $stmt->bindParam(':verified', $this->verified);
        $stmt->bindParam(':token', $this->token);


        if ($stmt->execute()) {
            return true;
        }

        // Print error message if something goes wrong
        printf("Error : %s. \n", $stmt->error);
        return false;
    }

    // Update user
    public function update() {

        // Update Query
       $query = 'Update users 
       SET
        email = :email,
        username = :username,
        pass = :pass,
        verified = :verified
       WHERE
        id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pass = htmlspecialchars(strip_tags($this->pass));
        $this->verified = 0;
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':pass', $this->pass); 
        $stmt->bindParam(':verified', $this->verified);
        $stmt->bindParam(':id', $this->id);
        
        // Execute query       
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if something goes wrong
        printf("Error : %s. \n", $stmt->error);
        return false;
    }

    // Delete User
    public function delete() {
        // Create query
        $query = 'DELETE FROM users WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean ID
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print error message if something goes wrong
        printf("Error : %s. \n", $stmt->error);
        return false;
    }

    public function check() {
        // Create query
        $query = 'SELECT id, email, username, pass, verified FROM users WHERE email= :email OR username = :username';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);

        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        // if (($row['email'] == $this->email) || ($row['username'] == $this->username)) {
        //     return true;
        // }

        if (is_array($row) && (($row['email'] == $this->email) || ($row['username'] == $this->username))) {
            return true;
        }

        return false;
    }

    public function check_creds() {
        // Create query
        $query = 'SELECT id, email, username, pass, verified 
                FROM users WHERE email = :email';

        $stmt = $this->conn->prepare($query);

        // Hash password
        $this->pass = md5($this->pass);

        $stmt->bindParam(':email', $this->email);

        // Execute query
        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        if ($row['email'] == $this->email && $row['pass'] == $this->pass) {
            return true;
        }

        return false;
    }

    public function find_id() {
        // Create Query
        $query = 'SELECT id FROM users WHERE token = :token';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':token', $this->token);

        // Execute query 
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
    }

    public function verify() {
        // Create update query
        $query = 'Update users 
        SET
         verified = :verified
        WHERE
         id = :id';

        $stmt = $this->conn->prepare($query);

        // Create new data
        $this->verified = 1;

        $stmt->bindParam(':verified', $this->verified);
        $stmt->bindParam(':id', $this->id);

        // Execute query 
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if something goes wrong
        printf("Error : %s. \n", $stmt->error);
        return false;
    }

    public function open_session() {

        // You should compare the hashes
        $this->pass = md5($this->pass);
        
        $query = 'SELECT id FROM users WHERE email = :email AND pass = :pass';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pass', $this->pass);

        // Execute query 
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];

        $_SESSION["id"] = $this->id;
        $_SESSION["email"] = $this->email;
        $_SESSION["auth"] = true;

        return true;
    }

    public function authenticate() {

        $this->id = $_SESSION['id'];
        $session = session_id();
        $id = $_SESSION['id'];


        $query = 'INSERT INTO account_sessions SET sess_id = :sess_id, account_id = :account_id, login_time = NOW()';

        // $query = "INSERT INTO account_sessions SET sess_id = '$session', account_id = $id, login_time = NOW()";
        $stmt = $this->conn->prepare($query);
        
        // var_dump(session_id());
        var_dump($_SESSION);
        
        $timestamp = "NOW()";
        // var_dump($timestamp);
        
        try {
            $stmt->bindParam(':sess_id', session_id());
            $stmt->bindParam(':account_id', $_SESSION['id']);
            // $stmt->bindParam(':login_time', "NOW()", PDO::PARAM_STR, 12);
            // var_dump($query);
            
            
            // Execute query 
            if ($stmt->execute()) {
                // var_dump($query);
                return true;
            }
        }
        catch (Exception $e){
            var_dump($e);
        }
        return false;
    }

    public function logout() {
        $query = 'INSERT INTO account_sessions SET sess_id = :sess_id, account_id = :account_id, login_time = NOW()';
    }

    public function save_img() {
           
        $query = 'INSERT INTO posts SET account_id = :account_id, post_id = :post_id, post = :post';

        $stmt = $this->conn->prepare($query);

        // var_dump($this->path_to_img);

        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', uniqid());
        $stmt->bindParam(':post', $this->path_to_img);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function gallery() {

        $query = 'SELECT post FROM posts WHERE account_id = :account_id LIMIT :offset, 5';

        $stmt = $this->conn->prepare($query);

        // $_SESSION['id'] = 12;

        // var_dump($_GET['offset']);
        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':offset', $_GET['offset'], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;

    }

}
?>