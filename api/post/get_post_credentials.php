<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/User.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Insert filename from data

    if (isset($data->filename)) {

        $user->filename = $data->filename;
    
        $user->get_post_id();
    
        $user_credentials = array(
            'post_id' => $user->post_id,
            'owner' => $user->owner,
            'likes' => $user->likes,
            'comments' => $user->comments,
        );
    
        
        echo json_encode($user_credentials);
    } else {
        echo 'An error occured';
    }
?>