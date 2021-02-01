(function () {

    var userinfos = null;
    var setpdp = null;
    var notifications = null;
    // var updateinfos = null;
    var setpicture = null;
    var img = null;
    var input = null;
    var fileList = null;

    // The buttons of update infos of the user

    var updateUsername = null;
    var updateEmail = null;
    var updatePassword = null;

    var username = null;
    var email = null;
    var password = null;

    var activate = null;
    var deactivate = null;

    // The hidden classes elements

    var first = null;
    var second = null;
    var third = null;

    var profile_pic = null;
    var errorMsg = null;
    var successMsg = null;

    function startup() {

    img = document.getElementById("pdp");
    input = document.getElementById("uploaded");
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

    profile_pic = document.getElementById("avatar");
    errorMsg = document.getElementById("error-message");
    successMsg = document.getElementById("success-message");

    // The buttons of user updating infos
    
    updateUsername = document.getElementById("update-username");
    updateEmail = document.getElementById("update-email");
    updatePassword = document.getElementById("update-password");

    // Activate/Deactivate buttons
    activate = document.getElementById('activate');
    deactivate = document.getElementById('deactivate');

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


    updateUsername.addEventListener('click', function (ev) {

        update_username();
        ev.preventDefault();
      }, false);

      updateEmail.addEventListener('click', function (ev) {

        update_email();
        ev.preventDefault();
      }, false);

      updatePassword.addEventListener('click', function (ev) {

        update_password();
        ev.preventDefault();
      }, false);

      setpicture.addEventListener('click', function (ev) {

        update_img();
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

    function update_username() {
      username = username.value;

      try {
        fetch("https://camagru-ik.cf/api/post/update_username.php", {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({username: username}),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Post Updated"}') {
              console.log("Credentials of the user were updated");
              successMsg.innerHTML = "Credentials of the user were updated";
            } else {
              errorMsg.innerHTML = data;
            }
          });
      } catch (error) {
        console.log(error);
      }

    }

    function update_email() {
      email = email.value;

      try {
        fetch("https://camagru-ik.cf/api/post/update_email.php", {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({email: email}),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Post Updated"}') {
              console.log("Credentials of the user were updated");
              successMsg.innerHTML = "Credentials of the user were updated";
            } else {
              errorMsg.innerHTML = data;
            }
          });
      } catch (error) {
        console.log(error);
      }
    }

    function update_password() {
      password = password.value;

      try {
        fetch("https://camagru-ik.cf/api/post/update_password.php", {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({pass: password}),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Post Updated"}') {
              console.log("Credentials of the user were updated");
              successMsg.innerHTML = "Credentials of the user were updated";
            } else {
              errorMsg.innerHTML = data;
            }
          });
      } catch (error) {
        console.log(error);
      }
    }

    // The function of updating all infos at a time

    function  update_infos() {

      username = username.value;
      email = email.value;
      password = password.value;

      try {
        fetch("https://camagru-ik.cf/api/post/update_users.php", {
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
              errorMsg.innerHTML = data;
            }
          });
      } catch (error) {
        console.log(error);
      }

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
                      errorMsg.innerHTML = "An error occured while uploading";
                    } else if (data == 'The uploaded image is not valid') {
                      errorMsg.innerHTML = data;
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

      var status = document.querySelector('.check p span');

      status.innerText = parameter.slice(0, -3) + 'e';

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
              errorMsg.innerHTML = data;
            }
          });
      } catch (error) {
        console.log(error);
      }


    }
    
    window.addEventListener('load', startup, false);
  })();