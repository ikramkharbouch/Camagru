
// This is an anonymous function
(function () {
  
    var input = null;
    var uploadbutton = null;

    var image = null;

    function startup() {

        input = document.getElementById('uploaded');
        uploadbutton = document.getElementById('upload');
        image = document.getElementById('output');


        input.addEventListener('change', function (ev) {
        const fileList = this.files;
        console.log(fileList);
        image.src = URL.createObjectURL(event.target.files[0]);
        ev.preventDefault();
        }, false);

     
    }
      
    window.addEventListener('load', startup, false);
  })();
