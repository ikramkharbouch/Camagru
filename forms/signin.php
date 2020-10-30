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
      <form>
      <div class="col">
      <div class="row">
        <input type="text" id="email" class="form-control form-control-lg form-control-sm" placeholder="Email">
      </div>
      <div class="row">
        <input type="password" id="pass" class="form-control form-control-lg" placeholder="Password">
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
  <!-- </div>
    <div class="container">

        
        <form id="checkUser">
            <div class="form-group mt-4">
                <input type="text" id="email" placeholder="Email" class="form-control border"/>
            </div>
            <div class="form-group">
                <input type="password" id="pass" placeholder="Pass" class="form-control border"/>
            </div>
            <input type="submit" value="Login" class="btn btn-primary"/>
        </form>
    </div> -->

    <script>
        document.getElementById("getUsers").addEventListener("click", getUsers);
        document.getElementById("checkUser").addEventListener("submit", checkUser);

      function getUsers() {
        fetch("http://54.163.108.123/Camagru/api/post/read.php")
          .then((res) => res.json())
          .then((data) => console.log(data))
          .catch((err) => console.log(err));
      }

      function checkUser(e) {
        e.preventDefault();

        let email = document.getElementById("email").value;
        let pass = document.getElementById("pass").value;

        fetch("http://54.163.108.123/Camagru/api/post/check_creds.php", {
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

              // Redirect
              console.log("I will redirect");
              window.location.href = "./Camagru/welcome.php";
            } else {

              // Reject
              document.getElementById("message").innerHTML = "This email or password is incorrect";
              console.log("I will not redirect");
            }
          });
      }

    </script>
</body>

</html>
