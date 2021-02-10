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

    if (isset($data->filename)) {

        $user->filename = $data->filename;
    
        $user->get_post_id();
    
        if ($user->like()) {
            echo json_encode(
                array('Message' => 'liked Successfully')
            );
        } else {
            echo json_encode(
                array('Message' => 'An Error Occured')
            );
        }
    } else {
        echo json_encode(
            array('Message' => 'An Error Occured')
        );
    }
?>