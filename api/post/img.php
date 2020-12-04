<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    $user->base64 = $data->base64;

    $user->base64 = substr($user->base64, 22);

    // Obtain the original content (usually binary data)
    $bin = base64_decode($user->base64);

    // Load GD resource from binary data
    $im = imageCreateFromString($bin);

    // Make sure that the GD library was able to load the image
    // This is important, because you should not miss corrupted or unsupported images
    if (!$im) {
        die('Base64 value is not a valid image');
    }

    // Specify the location where you want to save the image
    $img_file = tempnam('../../img', '');
    rename($img_file, $img_file .= '.png');
    chmod($img_file, 0644);

    // Save the GD resource as PNG in the best possible quality (no compression)
    // This will strip any metadata or invalid contents (including, the PHP backdoor)
    // To block any possible exploits, consider increasing the compression level
    imagepng($im, $img_file, 0);

    $im = imagecreatefrompng($img_file);
    imagefilter($im, IMG_FILTER_GRAYSCALE);

    imagepng($im, $img_file);

    $user->path_to_img = $img_file;

    if ($user->save_img()) {
        echo json_encode(
            array('Message' => 'Image Saved')
        );
    } else {
        echo json_encode(
            array('Message' => 'Image Not Saved')
        );
    }

?>