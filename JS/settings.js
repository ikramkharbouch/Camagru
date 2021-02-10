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

    var notif_status = null;
    var status = null;

    async function startup() {

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
    feedbackMsg = document.getElementById("error-message");
    // successMsg = document.getElementById("success-message");

    // The buttons of user updating infos
    
    updateUsername = document.getElementById("update-username");
    updateEmail = document.getElementById("update-email");
    updatePassword = document.getElementById("update-password");

    // Activate/Deactivate buttons
    activate = document.getElementById('activate');
    deactivate = document.getElementById('deactivate');

    status = document.querySelector('.check p span');

    set_current_values(username, email, password);

    notif_status = await set_notif_status();

    if (notif_status)
      status.innerHTML = 'Activated';
    else
      status.innerHTML = 'Deactivated';

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

        update_username(username.value);
        ev.preventDefault();
      }, false);

      updateEmail.addEventListener('click', function (ev) {

        update_email(email.value);
        ev.preventDefault();
      }, false);

      updatePassword.addEventListener('click', function (ev) {

        update_password(password.value);
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

    async function get_current_values() {

      try {
        const response = await fetch("https://camagru-ik.cf/api/post/get_values.php", {
          method: "GET",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
        })
          .then((res) => res.text());

          return response;
  
      } catch (error) {
        //console.log(error);
      }

    }

    async function set_current_values(email, username, password) {

      result = await get_current_values();

      regex_email = /(?<={"email":")(.*)(?=",)/g;
      regex_username = /(?<="username":")(.*)(?="})/g;

      email.value = result.match(regex_email);
      username.value = result.match(regex_username);
    }

    function display_hide(display, f_hide, s_hide) {

      display.className = 'display';
      f_hide.className = 'none-display';
      s_hide.className = 'none-display';
    }

    function update_username(username) {

      if (username) {
       
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
              if (data == 'Username Updated Successfully') {
                feedbackMsg.innerHTML = data;
                feedbackMsg.style.color = '#00ff00';
              } else {
                feedbackMsg.innerHTML = data;
                feedbackMsg.style.color = '#ff0000';
              }
            });
        } catch (error) {
          //console.log(error);
        }
      } else {
        feedbackMsg.innerHTML = 'No username was inserted';
        feedbackMsg.style.color = '#ff0000';
      }

    }

    function update_email(email) {

      if (email) {
        
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
              if (data == 'Email Updated Successfully') {
                feedbackMsg.innerHTML = data;
                feedbackMsg.style.color = '#00ff00';
              } else {
                feedbackMsg.innerHTML = data;
                feedbackMsg.style.color = '#ff0000';
              }
            });
        } catch (error) {
          //console.log(error);
        }
      } else {
        feedbackMsg.innerHTML = data;
        feedbackMsg.style.color = '#ff0000';
      }

    }

    function update_password(password) {

      if (password) {
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
              if (data == 'Password Updated Successfully') {
                feedbackMsg.innerHTML = data;
                feedbackMsg.style.color = '#00ff00';
              } else {
                feedbackMsg.innerHTML = data;
                feedbackMsg.style.color = '#ff0000';
              }
            });
          } catch (error) {
            //console.log(error);
          }
        } else {
          feedbackMsg.innerHTML = data;
          feedbackMsg.style.color = '#ff0000';
      }
    }


    function update_img() {

      const files = document.querySelector('[type=file]').files;
      const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            formData.append('files[]', file);
        };

        if (formData.get('files[]'))
        {

            fetch("https://camagru-ik.cf/api/post/update_img.php", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.text())
                .then((data) => {
                    if (data == '{"Message":"Image Not Uploaded"}') {
                      feedbackMsg.innerHTML = "An error occured while uploading";
                      feedbackMsg.style.color = '#ff0000';
                    } else if (data == 'The uploaded image is not valid') {
                      feedbackMsg.innerHTML = data;
                      feedbackMsg.style.color = '#ff0000';
                    } else {
                        profile_pic.src = "../".concat(data.substring(28));
                    }
    
                });
        }
        else {
            //console.log("No image was uploaded");
        }
      
    }

    function capitalizeFirstLetter(str) {

      // converting first letter to uppercase
      const capitalized = str.replace(/^./, str[0].toUpperCase());
  
      return capitalized;
  }

    function notifs_preferences(parameter) {

      var str = capitalizeFirstLetter(parameter.slice(0, -3) + 'ated');
      status.innerText = str;

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
              feedbackMsg.innerHTML = 'Status Updated';
              feedbackMsg.style.color = '#00ff00';
            } else {
              feedbackMsg.innerHTML = data;
              feedbackMsg.style.color = '#ff0000';
            }
          });
      } catch (error) {
        //console.log(error);
      }


    }

    async function set_notif_status() {

      try {
        const response = await fetch("https://camagru-ik.cf/api/post/notif_status.php", {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
        })
          .then((res) => res.text());

          if (response == 1)
            return true;
          else
            return false;
      } catch (error) {
        //console.log(error);
      }

    }
    
    window.addEventListener('load', startup, false);
  })();