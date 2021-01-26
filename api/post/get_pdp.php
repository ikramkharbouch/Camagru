<?php
    
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // // Get User ID
    // $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get user
    $user->get_pdp();

    echo $user->profile_pic;

    if (!isset($user->profile_pic)) {
        echo json_encode(
            array('message' => 'No Profile Picture Found')
        );
    }

?>