<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

if(isset($data->filename) && isset($data->comment) && isset($data->comment_id)) {

    $user->filename = $data->filename;
    
    $user->comment = $data->comment;
    
    $user->comment_id = $data->comment_id;
    
    $user->get_post_id();
    
    if ($user->delete_comment()) {
        echo json_encode(
            array('Message' => 'deleted successfully')
        );
    } else {
        echo json_encode(
            array('Message' => 'an error occured')
        );
    }
} else {
    echo json_encode(
        array('Message' => 'an error occured')
    );
}

?>