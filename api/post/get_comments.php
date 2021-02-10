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

 // Get raw posted data
 $data = json_decode(file_get_contents("php://input"));

 // Insert filename from data

 if (isset($data->filename)) {

     $user->filename = $data->filename;
     
     $user->get_post_id();
     
     // User query
     $result = $user->get_comments();
     
     
     // Get row count
     $num = $result->rowCount();
     
     // Check if any comments
     if ($num > 0) {
         // User array
         $comments_arr = array();
         $comments_arr['data'] = array();
     
         while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
             extract($row);
     
             $user_item = array(
                 'comment' => $comment,
                 'comment_id' => $comment_id,
                 'username' => $username,
             );
     
             // Push to "data"
             array_push($comments_arr['data'], $user_item);
         }
     
         // Turn to JSON && output
         echo json_encode($comments_arr);
     
     } else {
         // No Users
         echo json_encode(
             array('message' => 'No Comments Found')
         );
     
     }
 } else {
    echo json_encode(
        array('message' => 'No Comments Found')
    );
 }