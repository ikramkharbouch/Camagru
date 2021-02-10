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

$data = json_decode(file_get_contents("php://input"));

if (isset($data->status)) {
    if ($data->status  == 'activate') {
        $user->notifs = 1;
    } else {
        $user->notifs = 0;
    }
    
    if ($user->notifs_update()) {
        echo json_encode(
            array('Message' => 'Status Updated')
        );
    } else {
        echo json_encode(
            array('Message' => 'Status Not Updated')
        );
    }
} else {
    echo json_encode(
        array('Message' => 'Status Not Updated')
    );
}


?>