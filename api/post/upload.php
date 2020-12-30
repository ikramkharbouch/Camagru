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

    print_r($_FILES);

    var_dump($_FILES[files]["tmp_name"]);

    $user->uploaded_file = implode("", $_FILES[files]["tmp_name"]);

    var_dump($user->uploaded_file);


    if (move_uploaded_file($user->uploaded_file, '../../upload/1.png')) {
        copy('../../upload/1.png', '../../upload/2.png');
        copy('../../upload/1.png', '../../upload/3.png');
    }



    // $user->formData = $data->formData;

    // // var_dump($user->formData);
    // // var_dump($_FILES['image']['name']);

    // var_dump($data->form);
    // var_dump($user->file.name);

    // if(isset($_FILES['file']['name'])){
    //     // file name
    //     $filename = $_FILES['file']['name'];
     
    //     // Location
    //     $location = '../../upload/'.$filename;
     
    //     // file extension
    //     $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    //     $file_extension = strtolower($file_extension);
     
    //     // Valid extensions
    //     $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
     
    //     $response = 0;
    //     if(in_array($file_extension,$valid_ext)){
    //        // Upload file
    //        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    //           $response = 1;
    //        } 
    //     }
    //     echo $response;
    //     exit;
    //  }

    // if ($user->upload()) {
    //     echo json_encode(
    //         array('Message' => 'Image Uploaded')
    //     );
    // } else {
    //     echo json_encode(
    //         array('Message' => 'Image Not Uploaded')
    //     );
    // }

?>