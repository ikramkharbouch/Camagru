<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// Set data

if (isset($data->username)) {

    if ($data->username == $_SESSION["username"]) {
        echo 'Username is the same as the old one';
        exit();
    }
    
    $user->username = $data->username;

    if ($user->check_username()) {
        echo 'Another user already uses this username';
        exit();
    }

    if ($user->update_username()) {
        echo 'Username Updated Successfully';
    } else {
        echo 'Username should contain at least 3 letters and no characters or numbers';
    }
} else {
    echo json_encode(
        array('Message' => 'No value was inserted')
    );
}

?>