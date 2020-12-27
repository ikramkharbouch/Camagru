<?php

// try {

// // Define the Base64 value you need to save as an image
// $b64 = '';

// // Obtain the original content (usually binary data)
// $bin = base64_decode($b64);

// // Load GD resource from binary data
// $im = imageCreateFromString($bin);

// // Make sure that the GD library was able to load the image
// // This is important, because you should not miss corrupted or unsupported images
// if (!$im) {
//   die('Base64 value is not a valid image');
// }

// // Specify the location where you want to save the image
// $img_file = './img/second_img.png';

// // Save the GD resource as PNG in the best possible quality (no compression)
// // This will strip any metadata or invalid contents (including, the PHP backdoor)
// // To block any possible exploits, consider increasing the compression level
// imagepng($im, $img_file, 0);
// }
// catch (exception $e)
// {
//     echo $e;
// }

// $str = "ikram";

// $str = substr($str, 4);

// echo $str;

// echo $str;

// $dest = imagecreatefrompng('img/sig15b.png');
// $src = imagecreatefrompng('assets/emoji-inlove.png');

// imagecopymerge($dest, $src, 10, 10, 0, 0, 100, 47, 75);

// header('Content-Type: image/png');

// imagepng($dest);

?>

<!DOCTYPE html>

<html>
    <head>

    </head>

    <body>
        <label>Love</label><input type="radio" name="filter" value="Love" id="filter1"><br />
        <label>Happy</label><input type="radio" name="filter" value="Happy" id="filter2"> <br />
        <label>Sad</label><input type="radio" name="filter" value="Sad" id="filter3"> <br />

        <button disabled>Save</button>

        <script>

            var filter1 = document.getElementById('filter1');
            var filter2 = document.getElementById('filter2');
            var filter3 = document.getElementById('filter3');
            const button = document.querySelector('button');

            filter1.onclick = function() {
                console.log(filter1.value);
                button.disabled = false;
            };

            filter2.onclick = function() {
                console.log(filter2.value);
                button.disabled = false;
            };

            filter3.onclick = function() {
                console.log(filter3.value);
                button.disabled = false;
            };

        </script>
    </body>
</html>