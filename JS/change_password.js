// This is an anonymous function

(function () {

    var form = null;
    var password = null;
    var passwordConfirmation = null;
    var errorMsg = null;
    var token = null;

    function startup() {

        form = document.getElementById("checkUser");
        errorMsg = document.getElementById("error-message");

        // Get email

        token = (window.location.search.substr(1)).substr(6);

        //console.log(token);

        search_for_token(token);

        form.addEventListener('submit', function (ev) {
            changePassword(ev, token);
            ev.preventDefault();
        }, false);
    }


    function search_for_token(token) {
      
      try {
        fetch("https://camagru-ik.cf/api/post/search_token.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ reset_token: token }),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Token Does Not Exist"}') {
                window.location.href = '../404.php';
            } else {
              //console.log(data);
            }
          });
      } catch (error) {
        //console.log(error);
      }

    }
      
      function changePassword(e, token) {
        e.preventDefault();
        //console.log("token inside the function is", token);

        password = document.getElementById("password").value;
        passwordConfirmation = document.getElementById("passwordConfirmation").value;

        //console.log(password);
        //console.log(passwordConfirmation);

        if (password == passwordConfirmation) {
            try {
                fetch("https://camagru-ik.cf/api/post/change_password.php", {
                  method: "POST",
                  headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                  },
                  body: JSON.stringify({ token: token, pass: password }),
                })
                  .then((res) => res.text())
                  .then((data) => {
                    if (data == '{"Message":"The password was changed successfully"}') {
                        window.location.href = '../redirect_pages/changed_password.php';
                    } else {
                      errorMsg.innerHTML = "The password isn't valid";
                      errorMsg.style.color = '#ff0000';
                    }
                  });
              } catch (error) {
                //console.log(error);
              }
        } else {
            errorMsg.innerHTML = "The values of the passwords don't match";
            errorMsg.style.color = '#ff0000';
        }

        //console.log("end of execution");
      }

    window.addEventListener('load', startup, false);
})();


