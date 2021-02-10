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

    if (isset($data->reset_token)) {

        $user->reset_token = $data->reset_token;
    
        $user->get_user_id();
    
        if ($user->id != NULL) {
            echo json_encode(
                array('Message' => 'Token Exists')
            );
        } else {
            echo json_encode(
                array('Message' => 'Token Does Not Exist')
            );
        }
    } else {
        echo json_encode(
            array('Message' => 'Token Does Not Exist')
        );
    }

    
?>