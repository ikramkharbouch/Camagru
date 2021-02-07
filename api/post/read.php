<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// User query
$result = $user->read();

// Get row count
$num = $result->rowCount();

// Check if any users
if ($num > 0) {
    // User array
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

    // Turn to JSON && output
    echo json_encode($users_arr);

} else {
    // No Users
    echo json_encode(
        array('message' => 'No Users Found')
    );

}
