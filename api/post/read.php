<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $users = new Users($db);

    // Blog post query
    $result = $users->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any posts
    if ($num > 0) {
        // Post array
        $users_arr = array();
        $users_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $user_item = array(
                'id' => $id,
                'email' => $email,
                'username' => $username,
                'pass' => $pass,
                'verified' => $verified,
            );

            // Push to "data"
            array_push($users_arr['data'], $user_item);

        }

        // Turn to JSON  & output
        echo json_encode($users_arr);
    } else {
        // No Posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }

?>