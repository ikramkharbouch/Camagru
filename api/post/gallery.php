<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    @require('../../init.php');

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    // // Debug the last offset
    // var_dump($_GET['offset']);

    // Get The last offset
    $_GET['offset'] = (int)$_GET['offset'];

    $user->offset = isset($_GET['offset']) ? $_GET['offset'] : die();

    $result = $user->gallery();

    // Get row count
    $num = $result->rowCount();

    // Check if any users
    if ($num > 0) {
    // User array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'post' => $post
        );

        // Push to "data"
        array_push($posts_arr['data'], $post_item);
    }

    echo json_encode($posts_arr);

} else {
    // No Posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}

    // if ($user->gallery()) {
    //     echo json_encode(
    //         array('Message' => $_GET['offset'])
    //     );
    // } else {
    //     echo json_encode(
    //         array('Message' => 'Images Not Imported')
    //     );
    // }

?>