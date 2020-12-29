
// This is an anonymous function
(function () {
  
    var input = null;
    var uploadbutton = null;

    function startup() {
        
        input = document.getElementById('uploaded');
        uploadbutton = document.getElementById('upload');


        input.addEventListener('change', function (ev) {
        const fileList = this.files;
        console.log(fileList);
        ev.preventDefault();
        }, false);

     
    }
      
    window.addEventListener('load', startup, false);
  })();
