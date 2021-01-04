<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    @require('../../init.php');

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $type = substr(implode("", $_FILES[files]["type"]), 6);

    $type = '.' . $type;


    $user->uploaded_file = implode("", $_FILES[files]["tmp_name"]);

    $random_string = md5(uniqid(rand(), true));

    $filename = substr($random_string, 0, 5);

    if (move_uploaded_file($user->uploaded_file, '../../upload/'. $filename . $type)) {
        copy('../../upload/'. $filename . $type, '../../upload/2.jpg');
    }

    $user->uploaded_file = '/var/www/camagru-ik.cf/html/upload/' . $filename . $type;

    if ($user->upload()) {
        echo json_encode(
            array('Message' => 'Image Uploaded')
        );
    } else {
        echo json_encode(
            array('Message' => 'Image Not Uploaded')
        );
    }

?>