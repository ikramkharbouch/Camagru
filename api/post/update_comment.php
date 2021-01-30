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

// Set data
$user->filename = $data->filename;
$user->comment = $data->comment;

$user->get_post_id();

var_dump($user->filename);
var_dump($user->comment);

// Update User
if ($user->update_comment()) {
    echo json_encode(
        array('Message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('Message' => 'Post Not Updated')
    );
}

?>