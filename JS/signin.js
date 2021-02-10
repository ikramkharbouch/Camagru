// This is an anonymous function

(function () {

    var checkCurrentUser = null;
    var errorMsg = null;

    function startup() {

        checkCurrentUser = document.getElementById("checkUser");
        errorMsg = document.querySelector('p');

        checkCurrentUser.addEventListener('submit', function (ev) {
            checkUser(ev);
            ev.preventDefault();
        }, false);
    }

    function setErrorMsg() {
      errorMsg.innerHTML = 'False credentials or account is not activated yet';
    }

    async function get_email(username, pass) {

      try {
        const response = await fetch("https://camagru-ik.cf/api/post/get_email.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({username: username, pass: pass}),
        })
          .then((res) => res.text());

          return response;
  
      } catch (error) {
        //console.log(error);
      }
    }
      
      async function checkUser(e) {
        e.preventDefault();
      
        let username = document.getElementById("username").value;
        let pass = document.getElementById("pass").value;

        let email = await(get_email(username, pass));
      
        fetch("https://camagru-ik.cf/api/post/check_creds.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({username: username, pass: pass}),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"User Exists"}') {
              fetch("https://camagru-ik.cf/api/post/session.php", {
              method: "POST",
              headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({email: email, pass: pass}),
            })
            .then((res) => res.text())
            .then((data) => {
            if (data == '{"Message":"Session Created"}') {
                //console.log("Session Created");
                //console.log("I will redirect");
                fetch("https://camagru-ik.cf/api/post/auth.php", {
                method: "POST",
                headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
              },
             body: JSON.stringify({email: email, pass: pass}),
          })
            .then((res) => res.text())
            .then((data) => {
              if (data == '{"Message":"User Authenticated"}') {
                  //console.log("User Authenticated");
              } else {
                  //console.log("User Authenticated");
              }
            });
                  window.location.href = "./welcome.php";
              } else {
                  //console.log("Session Not Created");
              }
            });
            } else {
              setErrorMsg();
            }
          });
      }

    window.addEventListener('load', startup, false);
})();


