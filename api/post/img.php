<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
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

    if (isset($data->base64) && isset($data->filter)) {

        $user->base64 = $data->base64;
    
    
        $user->filter = $data->filter;
    
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
    
        // $im = imagecreatefrompng($img_file);
        // imagefilter($im, IMG_FILTER_GRAYSCALE);
    
        // imagepng($im, $img_file);
    
        function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
            // creating a cut resource
            $cut = imagecreatetruecolor($src_w, $src_h);
    
            // copying relevant section from background to the cut resource
            imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
           
            // copying relevant section from watermark to the cut resource
            imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
           
            // insert cut resource to destination image
            imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
        }
    
        // $img_file = substr($img_file, 5);
        // $img_file = "../../img/".$img_file;
    
    
        if ($user->filter) {
    
            $dest = imagecreatefrompng($img_file);
    
            if ($user->filter == 'Love')
                $src = imagecreatefrompng('../../assets/in-love-128.png');
            else if ($user->filter == 'Happy')
                $src = imagecreatefrompng('../../assets/happy-128.png');
            else if ($user->filter == 'Sad')
                $src = imagecreatefrompng('../../assets/sad-128.png');
            else {
                echo json_encode(
                    array('Message' => 'Filter Not Valid')
                );
                exit();
            }
    
            // imagecopymerge($dest, $src, 10, 10, 0, 0, 100, 47, 75);
    
            imagecopymerge_alpha($dest, $src, 10, 10, 0, 0, 128, 128, 100);
    
            header('Content-Type: image/png');
    
            imagepng($dest, $img_file);
            $user->path_to_img = $img_file;
        
            if ($user->save_img()) {
                echo json_encode(
                    array('Message' => $user->path_to_img)
                );
            } else {
                echo json_encode(
                    array('Message' => 'Image Not Saved')
                );
            }
        } else {
            echo json_encode(
                array('Message' => 'Image Not Saved')
            );
            exit();
        }
    } else {
        echo json_encode(
            array('Message' => 'Image Not Saved')
        );
    }

?>