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

    if (isset($data->username) && isset($data->pass)) {

        $user->username = $data->username;
        $user->pass = $data->pass;
    
        $user->get_email();
    
        if (!isset($user->email)) {
            echo json_encode(
                array('message' => 'No Username Found')
            );
        } else {
            echo $user->email;
        }
    } else {
        echo json_encode(
            array('message' => 'No Username Found')
        );
    }

?>