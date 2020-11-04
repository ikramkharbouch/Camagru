<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

var_dump("1");
require_once('../../PHPMailer/PHPMailerAutoload.php');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// var_dump(json_last_error());

$user->email = $data->email;
$user->username = $data->username;
$user->pass = md5($data->pass);
$user->token = md5(time());

var_dump($user->email);

if ($user->check()) {
    echo json_encode(
        array('Message' => 'User Exists')
    );
} else {
    if ($user->create()) {

        // $to = $user->email;
        // $subject = "Email Verification";

        // $message = "<body>
        //             <h1>Confirm Your Email</h1>
        //             Please confirm your email address " . "<a href='http://54.163.108.123/Camagru/api/post/verify.php?token=$user->token'>Verify Account</a>
        //             </body>";

        // // Always set content-type when sending HTML email
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // // More headers
        // $headers .= 'From: <webmaster@example.com>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";

        // mail($to, $subject, $message, $headers);

        echo json_encode(
            array('Message' => 'Post Created')
        );
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = '4573r14@gmail.com';
        $mail->Password = 'Fildefer1234@';

        $mail->SetFrom('no-reply@camagru.ml');
        $mail->Subject = 'Hello World';
        $mail->Body = 'A test 2 mail';
        $mail->AddAddress('geekgirl6667@gmail.com');

        $mail->Send();
    } else {
        echo json_encode(
            array('Message' => 'Post Not Created')
        );

    }
}
