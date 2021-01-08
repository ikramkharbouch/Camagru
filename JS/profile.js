(function () {

    var updateinfos = null;
    var setpicture = null;
    var img = null;
    var input = null;
    var fileList = null;
    
    function startup() {
      
    //   profile = document.querySelector(".user-details p");

    img = document.getElementById("pdp");
    input = document.getElementById("uploaded");
    updateinfos = document.getElementById("updateinfos");
    setpicture = document.getElementById("updateinfos");

    console.log(img);


    input.addEventListener('change', function (ev) {
      fileList = this.files;
      // this.form.image = event.target.files[0];
      // this.form.name = event.target.files[0].name;
      console.log(fileList);
      img.src = URL.createObjectURL(event.target.files[0]);
      ev.preventDefault();
     }, false);

      updateinfos.addEventListener('click', function (ev) {
        console.log('Call updateinfos function');
        window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);

      setpicture.addEventListener('click', function (ev) {
        console.log('Call updateinfos function');
        window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);
      
    }

    function  update_infos() {

    }

    function  set_picture() {
      
    }
    
    window.addEventListener('load', startup, false);
  })();