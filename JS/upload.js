
// This is an anonymous function
(function () {
  
    var input = null;
    var uploadbutton = null;

    var image = null;
    var fileList = null;

    function startup() {

        input = document.getElementById('uploaded');
        uploadbutton = document.getElementById('upload');
        image = document.getElementById('output');

        input.addEventListener('change', function (ev) {
            fileList = this.files;
            console.log(fileList);
            image.src = URL.createObjectURL(event.target.files[0]);
            ev.preventDefault();
        }, false);


        uploadbutton.addEventListener('click', function(ev) {
            send_img();
            ev.preventDefault();
        }, false);
     
    }

    function send_img() {

        console.log(fileList);
        console.log(1);

    }
      
    window.addEventListener('load', startup, false);
  })();
