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

    if (isset($data->pass) && isset($data->token)) {

        $user->pass = md5($data->pass);
        $user->reset_token = $data->token;
    
        // Search for token if not found return error
    
        $user->get_user_id();
    
        if ($user->id == NULL) {
            // Redirect the user
            header("Location: ../../404.php");
            echo json_encode(
                array('Message' => 'The password was not changed')
            );
            exit();
        }
    
        if ($user->change_password()) {
            echo json_encode(
                array('Message' => 'The password was changed successfully')
            );
        } else {
            echo json_encode(
                array('Message' => 'The password was not changed')
            );
        }
    } else {
        echo json_encode(
            array('Message' => 'The password was not changed')
        );
    }
?>