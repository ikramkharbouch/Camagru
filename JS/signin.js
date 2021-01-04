// This is an anonymous function

(function () {

    var getUser = null;
    var checkCurrentUser = null;

    function startup() {

        getUser = document.getElementById("getUsers");
        checkCurrentUser = document.getElementById("checkUser");

        checkCurrentUser.addEventListener('submit', function (ev) {
            checkUser(ev);
            ev.preventDefault();
        }, false);

        getUser.addEventListener('click', function (ev) {
            getUsers();
            ev.preventDefault();
        }, false);

    }

    function getUsers() {
        fetch("https://camagru-ik.cf/api/post/read.php")
          .then((res) => res.json())
          .then((data) => console.log(data))
          .catch((err) => console.log(err));
      }
      
      function checkUser(e) {
        e.preventDefault();
      
        let email = document.getElementById("email").value;
        let pass = document.getElementById("pass").value;
      
        fetch("https://camagru-ik.cf/api/post/check_creds.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({email: email, pass: pass}),
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
                console.log("Session Created");
                console.log("I will redirect");
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
                  console.log("User Authenticated");
              } else {
                  console.log("User Authenticated");
              }
            });
                  window.location.href = "./welcome.php";
              } else {
                  console.log("Session Not Created");
              }
            });
            } else {
              console.log("I will not redirect");
            }
          });
      }
      
      function open_session(e) {
              e.preventDefault();
      
              let email = document.getElementById("email").value;
              let pass = document.getElementById("pass").value;
              fetch("https://camagru-ik.cf/api/post/session.php", {
              method: "GET",
              headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({email: email, pass: pass}),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"Session created"}') {
                  console.log("Session Created");
            } else {
                  console.log("Session Not Created");
            }
          });
    }

    window.addEventListener('load', startup, false);
})();


