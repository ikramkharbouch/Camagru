<?php

    class User {
        // DB stuff
        private $conn;
        private $table = 'users';

        // User Properties
        public $id;
        public $fullname;
        public $email;
        public $username;
        public $pass;
        public $verified;
        public $base64;
        public $path_to_img;
        public $filter;
        public $offset;
        public $formData;
        public $uploaded_file;
        public $filename;
        public $post_id;
        public $owner;
        public $likes;
        public $comments;
        public $comment;
        public $notifs;
        public $profile_pic;
        public $liked;
        public $comment_id;

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
       $query = 'INSERT INTO users SET fullname = :fullname, email = :email, username = :username, pass = :pass, token = :token, verified = :verified, notifs = :notifs, profile_pic = :profile_pic;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pass = htmlspecialchars(strip_tags($this->pass));
        $this->verified = 0;
        $this->token = htmlspecialchars($this->token);
        $this->notifs = 1;
        $profile_pic = "test";

        //Check if data is empty
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (!filter_var($this->fullname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-z-A-Z]+/")))) {
            return false;
        }
        if (!filter_var($this->username, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[\w\s]+/")))) {
            return false;
        }
        if (!filter_var($this->pass, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-z-A-Z]+[0-9]+/")))) {
            return false;
        }

        // if(!($stmt->bind_param(':email', $this->email))){
        //     die( "Error in bind_param: (" .$this->conn->errno . ") " . $this->conn->error);
        // }


        $stmt->bindParam(':fullname', $this->fullname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':pass', $this->pass); 
        $stmt->bindParam(':verified', $this->verified, PDO::PARAM_INT);
        $stmt->bindParam(':notifs', $this->notifs, PDO::PARAM_INT);
        $stmt->bindParam(':token', $this->token);
        $stmt->bindParam(':profile_pic', $profile_pic, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        // Print error message if something goes wrong
        printf("Error : %s. \n", $stmt->error);
        return false;
    }

    // Update user
    public function update_users() {

        // Update Query
       $query = 'UPDATE users SET email = :email, username = :username, pass = :pass WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pass = htmlspecialchars(strip_tags($this->pass));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':pass', $this->pass); 
        $stmt->bindParam(':id', $_SESSION['id']);
        
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
           
        $query = 'INSERT INTO posts SET account_id = :account_id, post_id = :post_id, post = :post, likes = :likes, comments = :comments, creation_date = :creation_date';

        $stmt = $this->conn->prepare($query);


        $bool = 0;
        $date = date("Y-m-d");
        $unique_id = uniqid();

        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $unique_id);
        $stmt->bindParam(':post', $this->path_to_img);
        $stmt->bindParam(':likes', $bool);
        $stmt->bindParam(':comments', $bool);
        $stmt->bindParam(':creation_date', $date);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function gallery() {

        $query = 'SELECT post, likes, comments FROM posts WHERE 1 ORDER BY `creation_date` DESC LIMIT :offset, 5';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':offset', $this->offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }

    // FIXME: To optimize later if possible

    // TODO: To optimize later if possible
    
    public function upload() {
        
        $query = 'INSERT INTO posts SET account_id = :account_id, post_id = :post_id, post = :post, likes = :likes, comments = :comments, creation_date = :creation_date';

        $stmt = $this->conn->prepare($query);


        $bool = 0;
        $date = date("Y-m-d");

        $unique_id = uniqid();

        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $unique_id);
        $stmt->bindParam(':post', $this->uploaded_file);
        $stmt->bindParam(':likes', $bool);
        $stmt->bindParam(':comments', $bool);
        $stmt->bindParam(':creation_date', $date);

        if ($stmt->execute()) {
            return true;
        }
    }

    public function get_post_id() {

        $query = 'SELECT post_id,account_id,likes,comments FROM posts WHERE post = :post';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':post', $this->filename);

        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->post_id = $row['post_id'];
        $this->owner = $row['account_id'];
        $this->likes = $row['likes'];
        $this->comments = $row['comments'];
    }

    public function like() {

        $query = 'BEGIN;
                    UPDATE posts SET likes = :likes WHERE post_id = :post_id AND account_id = :account_id;
                    INSERT INTO user_likes SET account_id = :account_id, post_id = :post_id, liked = :liked;
                COMMIT;';

        $stmt = $this->conn->prepare($query);

        $bool = 1;

        $likes = $this->likes + 1;

        $stmt->bindParam(':likes', $likes, PDO::PARAM_INT);
        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':liked', $bool);

        if ($stmt->execute()) {
            return true;
        }

    }

    public function comment() {

        $query = 'BEGIN;
                    UPDATE posts SET comments = :comments WHERE post_id = :post_id AND account_id = :account_id;
                    INSERT INTO user_comments SET account_id = :account_id, post_id = :post_id, commented = :commented, comment = :comment;
        COMMIT;';

        $stmt = $this->conn->prepare($query);

        $bool = 1;

        $comments = $this->comments + 1;

        $stmt->bindParam(':comments', $comments, PDO::PARAM_INT);
        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':commented', $bool);
        $stmt->bindParam(':comment', $this->comment);

        if ($stmt->execute()) {
            return true;
        }

    }

    public function dislike() {

        $query = 'BEGIN;
                    DELETE FROM user_likes WHERE account_id = :account_id AND post_id = :post_id;
                    UPDATE `posts` SET `likes` = `likes` - 1 WHERE post_id = :post_id;
        COMMIT;';

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $this->post_id);

        if ($stmt->execute()) {
            return true;
        }

    }

    public function get_comments() {

        $query = 'SELECT `comment`, `comment_id` FROM `user_comments` WHERE post_id = :post_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':post_id', $this->post_id);

        $stmt->execute();

        return $stmt;

    }

    public function get_user() {

        $query = 'SELECT `username` FROM `users` WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_SESSION['id']);

        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->username = $row['username'];

    }

    public function delete_img() {

        $query = 'DELETE FROM `posts` WHERE account_id = :account_id AND post_id = :post_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $this->post_id);

        if ($stmt->execute()) {
            return true;
        }
        
        return false;

    }

    public function update_img() {

        $query = 'UPDATE users SET profile_pic = :profile_pic WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam('profile_pic', $this->uploaded_file);
        $stmt->bindParam('id', $_SESSION['id']);
        
        if ($stmt->execute()) {
            return true;
        } 
        
        return false;

    }

    public function notifs_update() {

        $query = 'UPDATE users SET notifs = :notifs WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam('notifs', $this->notifs);
        $stmt->bindParam('id', $_SESSION['id']);
        
        if ($stmt->execute()) {
            return true;
        } 
        
        return false;

    }

    public function get_pdp() {

        $query = 'SELECT `profile_pic` FROM `users` WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_SESSION['id']);

        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->profile_pic = $row['profile_pic'];

    }

    public function check_like() {

        $query = 'SELECT `liked` FROM `user_likes` WHERE post_id = :post_id AND account_id = :account_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':account_id', $_SESSION['id']);

        $stmt->execute();

        // Fetch data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->liked = $row['liked'];
        
    }

    public function update_comment() {
        
        $query = 'UPDATE `user_comments` SET `comment`= :comment WHERE post_id = :post_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':comment', $this->comment);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    // TODO: Fix the multiple comments with different users problem

    public function delete_comment() {

        $query = 'DELETE FROM `user_comments` WHERE post_id = :post_id AND comment_id = :comment_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':comment_id', $this->comment_id);

        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    
}
?>