<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $users = new Users($db);

    // Get ID
    $users->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get users
    $users->read_single();

    $users_arr = array(
        'id' => $users->id,
        'email' => $users->email,
        'username' => $users->username,
        'pass' => $users->pass,
        'verified' => $users->verified,
    );

    // Make JSON
    print_r(json_encode($users));

?>