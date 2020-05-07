<?php
// ----------------------------------------------------------------------------------------------------
// - Display Errors
// ----------------------------------------------------------------------------------------------------
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

// ----------------------------------------------------------------------------------------------------
// - Error Reporting
// ----------------------------------------------------------------------------------------------------
error_reporting(-1);

// ----------------------------------------------------------------------------------------------------
// - Shutdown Handler
// ----------------------------------------------------------------------------------------------------
function ShutdownHandler()
{
    if(@is_array($error = @error_get_last()))
    {
        return(@call_user_func_array('ErrorHandler', $error));
    };

    return(TRUE);
};

register_shutdown_function('ShutdownHandler');

// ----------------------------------------------------------------------------------------------------
// - Error Handler
// ----------------------------------------------------------------------------------------------------
function ErrorHandler($type, $message, $file, $line)
{
    $_ERRORS = Array(
        0x0001 => 'E_ERROR',
        0x0002 => 'E_WARNING',
        0x0004 => 'E_PARSE',
        0x0008 => 'E_NOTICE',
        0x0010 => 'E_CORE_ERROR',
        0x0020 => 'E_CORE_WARNING',
        0x0040 => 'E_COMPILE_ERROR',
        0x0080 => 'E_COMPILE_WARNING',
        0x0100 => 'E_USER_ERROR',
        0x0200 => 'E_USER_WARNING',
        0x0400 => 'E_USER_NOTICE',
        0x0800 => 'E_STRICT',
        0x1000 => 'E_RECOVERABLE_ERROR',
        0x2000 => 'E_DEPRECATED',
        0x4000 => 'E_USER_DEPRECATED'
    );

    if(!@is_string($name = @array_search($type, @array_flip($_ERRORS))))
    {
        $name = 'E_UNKNOWN';
    };

    return(print(@sprintf("%s Error in file \xBB%s\xAB at line %d: %s\n", $name, @basename($file), $line, $message)));
};

$old_error_handler = set_error_handler("ErrorHandler");

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
       $query = 'INSERT INTO users SET email = :email, username = :username, pass = :pass, verified = :verified';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pass = htmlspecialchars(strip_tags($this->pass));
        $this->verified = 0;

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':pass', $this->pass); 
        $stmt->bindParam(':verified', $this->verified);
        
        // Execute query
        var_dump($this->email);
        var_dump($this->username);
        var_dump($this->pass);
        var_dump($this->verified);
        
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if something goes wrong
        printf("Error : %s. \n", $stmt->error);
        return true;
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
        var_dump($this->email);
        var_dump($this->username);
        var_dump($this->pass);
        var_dump($this->verified);
        
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

}
?>