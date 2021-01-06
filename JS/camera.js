(function () {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 600;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var video = null;
  var canvas = null;
  var photo = null;
  // var startbutton = null;
  var savebutton = null
  var base64 = null;
  var filter1 = null;
  var filter2 = null;
  var filter3 = null;
  var lastFilter = null;
  var src = null;
  

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
    // startbutton = document.getElementById('startbutton');
    savebutton = document.getElementById('savebutton');
    filter1 = document.getElementById('filter1');
    filter2 = document.getElementById('filter2');
    filter3 = document.getElementById('filter3');

    src = document.getElementById('x');

    video.onloadedmetadata = function (e) {
      video.play();
    };

    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
      .then(function (stream) {
        video.srcObject = stream;
        video.play();
      })
      .catch(function (err) {
        console.log("An error occurred: " + err);
      });

    video.addEventListener('canplay', function (ev) {
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

    // startbutton.addEventListener('click', function (ev) {
    //   takepicture();
    //   ev.preventDefault();
    // }, false);
    savebutton.addEventListener('click', function (ev) {
      savepicture();
      ev.preventDefault();
    }, false);

    filter1.addEventListener('click', function (ev) {
      console.log(filter1);
      console.log(filter1.value);
      lastFilter = filter1.value;
      savebutton.disabled = false;
    }, false);

    filter2.addEventListener('click', function (ev) {
      console.log(filter2);
      console.log(filter2.value);
      lastFilter = filter2.value;
      savebutton.disabled = false;
    }, false);

    filter3.addEventListener('click', function (ev) {
      console.log(filter3);
      console.log(filter3.value);
      lastFilter = filter3.value;
      savebutton.disabled = false;
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

  function savepicture() {

    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);

      var data = canvas.toDataURL('image/png');
      console.log(data);

      base64 = data;
      photo.setAttribute('src', data);

      console.log(lastFilter);
      console.log("Called the function");
      try {
        fetch("https://camagru-ik.cf/api/post/img.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ base64: base64, filter: lastFilter }),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Image Not Saved"}') {
              console.log("Image Not Saved");
            } else {
              console.log(data);   
              var str = '../img/';
              data = data.substring(50);
              data = data.substring(0, data.length - 2);
              // console.log(data);
              data = str.concat(data);
              console.log(data);
              var img = document.createElement('img');
              img.style.height = '200px';
              img.style.width = '200px';
              img.src = data;
              src.appendChild(img);
            }
          });
      } catch (error) {
          console.log(error);
      }
    } else {
      clearphoto();
    }
  }

  // function takepicture() {
  //   var context = canvas.getContext('2d');
  //   if (width && height) {
  //     canvas.width = width;
  //     canvas.height = height;
  //     context.drawImage(video, 0, 0, width, height);

  //     var data = canvas.toDataURL('image/png');
  //     console.log(data);

  //     base64 = data;
  //     photo.setAttribute('src', data);
  //   } else {
  //     clearphoto();
  //   }
  // }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);
})();