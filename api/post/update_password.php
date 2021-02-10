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

if (isset($data->pass)) {

    $user->email = md5($data->pass);

    if ($user->update_password()) {
        echo 'Password Updated Successfully';
    } else {
        echo 'Password should contain minimum 8 characters, at least one letter and one number';
    }
} else {
    echo json_encode(
        array('Message' => 'No value was inserted')
    );
}

?>