<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// Get User Token
$user->token = isset($_GET['token']) ? $_GET['token'] : die();

$user->find_id();

$user->read_single();

if ($user->verified == 1) {
    echo json_encode(
        array('Message' => 'User Already Verified')
    );
} else {
    if ($user->verify()) {
        echo json_encode(
            array('Message' => 'User Was Verified Successfully')
        );
    } else {
        echo json_encode(
            array('Message' => 'User Was Not Verified')
        );
    }
}
