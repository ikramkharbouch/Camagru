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

    $data = json_decode(file_get_contents("php://input"));
 
    if (isset($data->email) && isset($data->pass)) {

        $user->email = $data->email;
        $user->pass = $data->pass;
    
        if ($user->authenticate()) {
            echo json_encode(
                array('Message' => 'User Authenticated')
            );
        } else {
            echo json_encode(
                array('Message' => 'User Not Authenticated')
            );
        }
    } else {
        echo json_encode(
            array('Message' => 'User Not Authenticated')
        );
    }

?>