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

    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->post_id)) {

        $user->post_id = $data->post_id;
    
        // Get user
        $user->get_path();
    
        // echo $user->profile_pic;
    
        if ($user->filename)
            echo $user->filename;
        else {
            echo 'Image does not exist';
        }
    } else {
        echo 'Image does not exist';
    }

?>