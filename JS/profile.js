(function () {

    var userinfos = null;
    var setpdp = null;
    var notifications = null;
    var updateinfos = null;
    var setpicture = null;
    var img = null;
    var input = null;
    var fileList = null;

    var username = null;
    var email = null;
    var password = null;

    // The hidden classes elements

    var first = null;
    var second = null;
    var third = null;
    
    function startup() {
      
    //   profile = document.querySelector(".user-details p");

    img = document.getElementById("pdp");
    input = document.getElementById("uploaded");
    updateinfos = document.getElementById("updateinfos");
    setpicture = document.getElementById("setpicture");

    userinfos = document.getElementById("userinfos");
    setpdp = document.getElementById("setpdp");
    notifications = document.getElementById("notifs");

    username = document.getElementById("user-name");
    email = document.getElementById("email");
    password = document.getElementById("password");

    // Getting the hidden classes to change their style

    first = document.getElementById("user-info");
    second = document.getElementById("profile-picture");
    third = document.getElementById("notifications");

    console.log(img);

    input.addEventListener('change', function (ev) {
      fileList = this.files;
      // this.form.image = event.target.files[0];
      // this.form.name = event.target.files[0].name;
      console.log(fileList);
      img.src = URL.createObjectURL(event.target.files[0]);
      ev.preventDefault();
     }, false);

     // User infos button event on click

     userinfos.addEventListener('click', function (ev) {
      console.log("userinfos");
      console.log(first);
      
      // Make the class visible to the user

      display_hide(first, second, third);

      ev.preventDefault();
    }, false);

    // Set profile picture button event on click

    setpdp.addEventListener('click', function (ev) {
      console.log("setpdp");

      display_hide(second, first, third);
      
      ev.preventDefault();
    }, false);

    // Activate or deactivate notifications button event on click

    notifications.addEventListener('click', function (ev) {
      console.log("notifications");

      display_hide(third, first, second);
      
      ev.preventDefault();
    }, false);


      updateinfos.addEventListener('click', function (ev) {

        console.log('Call update infos function');

        update_infos();

        // window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);

      setpicture.addEventListener('click', function (ev) {
        console.log('Call updateinfos function');
        // window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);
      
    }

    function display_hide(display, f_hide, s_hide) {

      display.className = 'display';
      f_hide.className = 'none-display';
      s_hide.className = 'none-display';
    }

    function  update_infos() {

      username = username.value;
      email = email.value;
      password = password.value;

      try {
        fetch("https://camagru-ik.cf/api/post/update.php", {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({email: email, username: username, pass: password}),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Post Updated"}') {
              console.log("Credentials of the user were updated");
            } else {

              console.log(data);
              // console.log("Credentials of the user were not updated");
            }
          });
      } catch (error) {
        console.log(error);
      }

    }

    function  set_picture() {
      
    }
    
    window.addEventListener('load', startup, false);
  })();