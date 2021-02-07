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

    // Get User ID
    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get user
    $user->read_single();

    // Create array
    $user_arr = array(
        'id' => $user->id,
        'email' => $user->email,
        'username' => $user->username,
        'pass' => $user->pass,
        'verified' => $user->verified,
    );

    // Make JSON
    print_r(json_encode($user_arr));

?>