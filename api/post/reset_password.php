<?php
// Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    include_once '../../config/database.php';
    include_once '../../models/User.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->email)) {

        $user->email = $data->email;
    
        // Generate a new token and insert it to get the user's data
        $user->reset_token = uniqid();
    
        $user->email_found();
    
        if ($user->id != NULL) {
    
            $user->insert_reset_token();
        
            $to      = $user->email;
            $subject = 'Reset your password';
            $message = "
                        <!DOCTYPE html>
                        <html><body style='text-align:center;'>
                        <h1>Confirm Your Email</h1><br />
                        Reset your password here " . "<a href='https://camagru-ik.cf/forms/change_password.php?token=$user->reset_token'><button style='background-color: #4CAF50; /* Green */
                        border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;'>Reset Password</button></a>
                        </body></html>
                        ";
        
            $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to, $subject, $message, $headers);
        
            echo 'Email sent successfully';
        } else {
            echo 'Email was not found in database';
        }
    } else {
        echo 'Email was not found in database';
    }


?>