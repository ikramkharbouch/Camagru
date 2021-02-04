<?php
// Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    include_once '../models/User.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $user->pass = md5($data->pass);
    $user->email = $data->email;

    if ($user->change_password()) {
        echo json_encode(
            array('Message' => 'The password was changed successfully')
        );
    } else {
        echo json_encode(
            array('Message' => 'The password was not changed')
        );
    }
?>