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

if (isset($data->email)) {
    
    $user->email = $data->email;
    
    // Update User
    if (isset($user->email)) {
        if ($user->update_email()) {
            echo 'Email Updated Successfully';
        } else {
            echo 'Email should contain 8 letters';
        }
    } else {
        echo json_encode(
            array('Message' => 'No value was inserted')
        );
    }
} else {
    echo json_encode(
        array('Message' => 'No value was inserted')
    );
}

?>