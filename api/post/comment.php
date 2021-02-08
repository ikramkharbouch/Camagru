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

    $user->filename = $data->filename;
    $user->comment = $data->comment;

    $user->get_post_id();

    $rest = '..' . substr($user->filename, 27);

    if ($user->comment()) {
        if ($user->notifs == 1)
        {
        $to      = $user->email_of_owner;
        $subject = 'Somebody commented your post';
        $message = "
                    <!DOCTYPE html>
                    <html><body style='text-align:center;'>
                    <h1>somebody commented your following post</h>
                    <a href='https://camagru-ik.cf/forms/comment.php?path=$rest'><button style='background-color: #4CAF50; /* Green */
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                     display: inline-block;
                    font-size: 16px;'>See more</button></a>
                    </body></html>
                    ";
        
        $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $message, $headers);

    }
    echo json_encode(
        array('Message' => 'Commented Successfully')
    );
    } else {
        echo json_encode(
            array('Message' => 'An Error Occured')
        );
    }

?>