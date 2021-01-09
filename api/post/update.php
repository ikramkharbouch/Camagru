<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// // Update ID
// $user->id = $data->id;

// Set data
$user->email = $data->email;
$user->username = $data->username;
$user->pass = $data->pass;

// Update User
if ($user->update()) {
    echo json_encode(
        array('Message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('Message' => 'Post Not Updated')
    );
}
