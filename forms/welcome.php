<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
  <!-- <h1>Welcome to Camagru</h1>
    <video id="video"></video>
    <canvas id="canvas"></canvas>
    <button onclick="snap();">Snap</button>
    <a href="img.png" download="output.png">Download</a> -->

    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <h1>Camagru</h1>
      <a href="#">Home</a>
      <a href="#">Gallery</a>
      <a href="#">Profile</a>
      <a href="#">Settings</a>
      <a href="#">Logout</a>
    </div>

  <!-- Use any element to open the sidenav -->
  <span onclick="openNav()"><i class="fas fa-bars"></i>
</span>

<div class="user-details d-flex flex-row">
<p>Ikram Kharbouch</p>
<img src="../assets/avatar.png" alt="Avatar" class="avatar">
</div>


  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
    <div class="camera">
    <button id="startbutton" type="button" class="btn btn-primary btn-lg">Start Capture</button>
    <button id="startbutton" type="button" class="btn btn-danger btn-lg" onclick="clearphoto()">Reset</button>
    <video id="video">Video stream not available.</video>
    
  </div>

  <canvas id="canvas">
  </canvas>
  <!-- <div class="output">
    <img id="photo" alt="The screen capture will appear in this box.">
  </div> -->
  </div>

  <div class="emojis">
    <h3>Add Emojis</h3>
    <div class="container">
  <div class="row row-cols-2">
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
  </div>
</div>
  </div>



  <script type="text/javascript">
  function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";

}
    (function() {
      // The width and height of the captured photo. We will set the
      // width to the value defined here, but the height will be
      // calculated based on the aspect ratio of the input stream.

      var width = 320; // We will scale the photo width to this
      var height = 0; // This will be computed based on the input stream

      // |streaming| indicates whether or not we're currently streaming
      // video from the camera. Obviously, we start at false.

      var streaming = false;

      // The various HTML elements we need to configure or control. These
      // will be set by the startup() function.

      var video = null;
      var canvas = null;
      var photo = null;
      var startbutton = null;

      function startup() {
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        photo = document.getElementById('photo');
        startbutton = document.getElementById('startbutton');

        navigator.mediaDevices.getUserMedia({
            video: true,
            audio: false
          })
          .then(function(stream) {
            video.srcObject = stream;
            video.play();
          })
          .catch(function(err) {
            console.log("An error occurred: " + err);
          });

        video.addEventListener('canplay', function(ev) {
          if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);

            // Firefox currently has a bug where the height can't be read from
            // the video, so we will make assumptions if this happens.

            if (isNaN(height)) {
              height = width / (4 / 3);
            }

            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
          }
        }, false);

        startbutton.addEventListener('click', function(ev) {
          takepicture();
          ev.preventDefault();
        }, false);

        clearphoto();
      }

      // Fill the photo with an indication that none has been
      // captured.

      function clearphoto() {
        var context = canvas.getContext('2d');
        context.fillStyle = "#AAA";
        context.fillRect(0, 0, canvas.width, canvas.height);

        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
      }

      // Capture a photo by fetching the current contents of the video
      // and drawing it into a canvas, then converting that to a PNG
      // format data URL. By drawing it on an offscreen canvas and then
      // drawing that to the screen, we can change its size and/or apply
      // other changes before drawing it.

      function takepicture() {
        var context = canvas.getContext('2d');
        if (width && height) {
          canvas.width = width;
          canvas.height = height;
          context.drawImage(video, 0, 0, width, height);

          var data = canvas.toDataURL('image/png');
          photo.setAttribute('src', data);
        } else {
          clearphoto();
        }
      }

      // Set up our event listener to run the startup process
      // once loading is complete.
      window.addEventListener('load', startup, false);
    })();










    // var video = document.getElementById('video');
    // var canvas = document.getElementById('canvas');
    // var context = canvas.getContext('2d');
    // var download = document.getElementById('download');

    // navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia

    // // Checking the permission of the user to use the webcam
    // if (navigator.mediaDevices.getUserMedia) {
    //     navigator.getUserMedia({video:true}, streamWebCam, throwError);
    // }

    // // First Callback after agreement
    // function streamWebCam (stream) {
    //     video.srcObject = stream;
    //     video.play();
    // }

    // // Callback after disagreement
    // function throwError(e) {
    //     alert(e.name);
    // }

    // function snap() {
    //     canvas.width = video.clientWidth;
    //     canvas.height = video.clientHeight;
    //     context.drawImage(video, 0, 0);
    // }

    // // function download() {
    // //     var dataURL = canvas.toDataURL();
    // //     var newData = dataURL.replace("image/png", "image/octet-stream");
    // //     download.attr("download", "VaishIvfBiodata.png").attr("href", newData);
    // // }

    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
</script>
</body>

</html>
