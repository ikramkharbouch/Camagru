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
    <div class="container">
        <button class="btn btn-warning mt-4" id="getUsers">Get API Data</button>
        <form id="addPost">
            <div class="form-group mt-4">
                <input type="text" id="email" placeholder="Email" class="form-control border" required/>
            </div>
            <div class="form-group">
                <input type="text" id="username" placeholder="Username" class="form-control border" required/>
            </div>
            <div class="form-group">
                <input type="password" id="pass" placeholder="Pass" class="form-control border" required/>
            </div>
            <input type="submit" value="Register" class="btn btn-primary"/>
        </form>
    </div>
    
    <script>
        document.getElementById("addPost").addEventListener("submit", addPost);
        document.getElementById("getUsers").addEventListener("click", getUsers);

        function addPost(e) {
        e.preventDefault();

        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let pass = document.getElementById("pass").value;

        fetch("http://localhost/api/post/create.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({username: username, email: email, pass: pass}),
        })
          .then((res) => res.text())
          .then((data) => console.log(data));
      }

      function getUsers() {
        fetch("http://localhost/api/post/read_single.php?id=2")
          .then((res) => res.json())
          .then((data) => console.log(data))
          .catch((err) => console.log(err));
      }
    </script>
</body>

</html>
