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

$data = json_decode(file_get_contents("php://input"));

// Get the type of the sent image (png, jpeg, jpg)

$type = substr(implode("", $_FILES[files]["type"]), 6);

$type = '.' . $type;

// Get the path of the uploaded image

$user->uploaded_file = implode("", $_FILES[files]["tmp_name"]);

// Set random name for the new saved image 

$random_string = md5(uniqid(rand(), true));

// Set a string of 5 characters

$filename = substr($random_string, 0, 5);

// To remove 2.png later

if (move_uploaded_file($user->uploaded_file, '../../profile_pics/'. $filename . $type)) {
    copy('../../profile_pics/'. $filename . $type, '../../profile_pics/2.jpg');
}

$user->uploaded_file = '/var/www/camagru-ik.cf/html/profile_pics/' . $filename . $type;

if ($user->update_img()) {
    echo json_encode(
        array('Message' => 'Image Uploaded')
    );
} else {
    echo json_encode(
        array('Message' => 'Image Not Uploaded')
    );
}

?>