// This is an anonymous function

(function () {

    var form = null;
    var password = null;
    var passwordConfirmation = null;
    var errorMsg = null;
    var email = null;

    function startup() {

        form = document.getElementById("checkUser");
        errorMsg = document.getElementById("error-message");

        // Get email

        email = (window.location.search.substr(1)).substr(6);

        console.log(email);

        form.addEventListener('submit', function (ev) {
            changePassword(ev);
            ev.preventDefault();
        }, false);
    }
      
      function changePassword(e, param1, param2) {
        e.preventDefault();

        password = document.getElementById("password").value;
        passwordConfirmation = document.getElementById("passwordConfirmation").value;

        console.log(password);
        console.log(passwordConfirmation);

        if (password == passwordConfirmation) {
            try {
                fetch("https://camagru-ik.cf/api/post/change_password.php", {
                  method: "POST",
                  headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                  },
                  body: JSON.stringify({ email: email, pass: password }),
                })
                  .then((res) => res.text())
                  .then((data) => {
                    if (data == '{"Message":"The password was changed successfully"}') {
                        window.location.href = '../redirect_pages/changed_password.php';
                    } else {
                      console.log(data);
                    }
                  });
              } catch (error) {
                console.log(error);
              }
        } else {
            errorMsg.innerHTML = "The values of the passwords don't match";
            errorMsg.style.color = '#ff0000';
        }

        console.log("end of execution");
      }

    window.addEventListener('load', startup, false);
})();


