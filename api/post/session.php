<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->email = $data->email;
    $user->pass = $data->pass;

    if ($user->open_session()) {
        echo json_encode(
            array('Message' => 'Session Created')
        );
        var_dump($_SESSION["id"]);
        var_dump($_SESSION["email"]);
    } else {
        echo json_encode(
            array('Message' => 'Session Was Not Created')
        );
    }

?>