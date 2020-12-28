<?php

@require('../init.php');

var_dump($_SESSION['auth']);

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) 
{
  header("Location: ../forms/welcome.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="icon" href="/assets/Camagru-favicon.png">
    <link rel="stylesheet" href="../styles/sign.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div class="sign-in d-flex flex-column">
    <img src="../assets/Sign-in.png" alt="">

    <div class="container">
      <h1>Sign In to <span>Camagru</span></h1>
      <form id="checkUser">
      <div class="col">
      <div class="row">
        <input type="text" id="email" class="form-control form-control-lg form-control-sm" placeholder="Email" required>
      </div>
      <div class="row">
        <input type="password" id="pass" class="form-control form-control-lg" placeholder="Password" required>
      </div>
      <div class="row check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember your password ?</label>
      </div>
      <div class="row">
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn">Sign In</button>
      </div>

    </div>
    </form>
    </div>

    <button class="btn btn-warning mt-4" id="getUsers">Get API Data</button>
    <p id="message" class="text-danger mt-2"></p>

    <script>

      document.getElementById("getUsers").addEventListener("click", getUsers);
      document.getElementById("checkUser").addEventListener("submit", checkUser);

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
    </script>
</body>

</html>
