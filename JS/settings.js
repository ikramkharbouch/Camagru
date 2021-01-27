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

    var activate = null;
    var deactivate = null;

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


    // Activate/Deactivate buttons
    activate = document.getElementById('activate');
    deactivate = document.getElementById('deactivate');


    console.log(img);

    input.addEventListener('change', function (ev) {
      fileList = this.files;
      img.src = URL.createObjectURL(ev.target.files[0]);
      ev.preventDefault();
     }, false);

     // User infos button event on click

    userinfos.addEventListener('click', function (ev) {
      
      // Make the class visible to the user

      display_hide(first, second, third);

      ev.preventDefault();
    }, false);

    // Set profile picture button event on click

    setpdp.addEventListener('click', function (ev) {

      display_hide(second, first, third);
      
      ev.preventDefault();
    }, false);

    // Activate or deactivate notifications button event on click

    notifications.addEventListener('click', function (ev) {

      display_hide(third, first, second);
      
      ev.preventDefault();
    }, false);


    updateinfos.addEventListener('click', function (ev) {

        update_infos();

        // Clear the values of inputs 

        // clear_values();

        // window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);

      setpicture.addEventListener('click', function (ev) {

        update_img();
        // window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);

      activate.addEventListener('click', function (ev) {

        notifs_preferences('activate');
        ev.preventDefault();
      }, false);

      deactivate.addEventListener('click', function (ev) {

        notifs_preferences('deactivate');
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
            }
          });
      } catch (error) {
        console.log(error);
      }

    }

    function clear_values() {

      username.value = '';
      email.value = '';
      password.value = '';
    }

    function update_img() {

      console.log('update image');

      const files = document.querySelector('[type=file]').files;
      const formData = new FormData();

      console.log(files[0].name);

        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            formData.append('files[]', file);
        };

        console.log(formData.get('files[]'));

        if (formData.get('files[]'))
        {

            fetch("https://camagru-ik.cf/api/post/update_img.php", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.text())
                .then((data) => {
                    if (data == '{"Message":"Image Not Uploaded"}') {
                        console.log("Error");
                    } else {
                        console.log("Success");
                        console.log(data);
                        profile_pic.src = "../".concat(data.substring(28));
                    }
    
                });
        }
        else {
            console.log("No image was uploaded");
        }
      
    }

    function notifs_preferences(parameter) {

      console.log(parameter);

      var status = document.querySelector('.check p span');

      status.innerText = parameter.slice(0, -3) + 'e';

      console.log(status);

      try {
        fetch("https://camagru-ik.cf/api/post/notifications.php", {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ status: parameter }),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Status Updated"}') {
              console.log(data);
            } else {
              console.log(data);
            }
          });
      } catch (error) {
        console.log(error);
      }


    }
    
    window.addEventListener('load', startup, false);
  })();