<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/database.php';
    include_once '../../models/User.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->filter = $_POST["filter"];

    // Get the type of the uploaded file

    if (isset($_FILES['files']) && isset($_POST['filter'])) {
    $type = substr(implode("", $_FILES['files']["type"]), 6);

    $type = '.' . $type;

     // Get the path of the uploaded file

    $user->uploaded_file = implode("", $_FILES['files']["tmp_name"]);

    $random_string = md5(uniqid(rand(), true));

    $filename = substr($random_string, 0, 5);

    $img_file = "../../upload/" .$filename .".png";

    if (@exif_imagetype($user->uploaded_file)) {

        if ($type == ".jpeg")
            $png = imagepng(imagecreatefromjpeg($user->uploaded_file), $img_file);
        else
            $png = imagepng(imagecreatefrompng($user->uploaded_file), $img_file);
    } else {
        echo 'The file uploaded is not an image';
        exit();
    }

    // The function to place the filter on the image using alpha method

    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
       
        // copying relevant section from watermark to the cut resource
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
       
        // insert cut resource to destination image
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    // Apply the user filter on the image

    if ($user->filter) {

        $dest = imagecreatefrompng($img_file);

        if ($user->filter == 'Love')
            $src = imagecreatefrompng('../../assets/in-love-128.png');
        else if ($user->filter == 'Happy')
            $src = imagecreatefrompng('../../assets/happy-128.png');
        else if ($user->filter == 'Sad')
            $src = imagecreatefrompng('../../assets/sad-128.png');

        // imagecopymerge($dest, $src, 10, 10, 0, 0, 100, 47, 75);

        imagecopymerge_alpha($dest, $src, 10, 10, 0, 0, 128, 128, 100);

        header('Content-Type: image/png');

        imagepng($dest, $img_file);
    } else {
        echo json_encode(
            array('Message' => 'Image Not Saved')
        );
        exit();
    }

    // A variable to save in the database
    
    $user->uploaded_file = '/var/www/camagru-ik.cf/html/upload/' . $filename . ".png";

    // Check the image before uploading it


    function is_image($path)
    {
        $output = exif_imagetype($path);
        var_dump($output);
        $a = getimagesize($path);
        $image_type = $a[2];
	
        if(in_array($image_type , array(IMAGETYPE_JPEG ,IMAGETYPE_PNG)))
        {
            return true;
        }
        return false;
    }

    if (is_image($user->uploaded_file)) {
        
        if ($user->upload()) {
            echo json_encode(
                array('Message' => 'Image Uploaded')
            );
        } else {
            echo json_encode(
                array('Message' => 'Image Not Uploaded')
            );
        }
    } else 
    {
        echo 'The file uploaded is not an image';
    }
} else {
    echo 'The file uploaded is not an image';
}


?>