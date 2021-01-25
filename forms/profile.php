<?php
  @require('../init.php');

  if (!isset($_SESSION['auth']) && $_SESSION['auth'] == false) 
  {
    header("Location: ../404.php");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Camagru</title>
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="../styles/profile.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="../JS/menu.js"></script>
  <script src="../JS/profile.js"></script>
</head>

<body>

  <?php include '../components/menu.html';?>
    <div class="container">
      <h1>User settings</h1>
      <div class="second-container d-flex flex-row flex-wrap">
      
      <div class="left d-flex flex-column flex-wrap">
        <h3>Informations</h3>
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn" id="userinfos">User Infos</button>
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn" id="setpdp">Set Profile Picture</button>
        <h3>Notifications</h3>
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn" id="notifs">Preferences</button>
      </div>
      <div class="right">
        <div class="user-info" id="user-info">
          <h3>Update user info</h3>

          <div class="inputs">
  
  
            <div class="credentials">
  
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control" id="user-name" placeholder="Username" value="">
              </div>
              <div class="mb-3 email">
                  <label for="exampleFormControlInput1" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com" value="">
              </div>
              <div class="mb-3 password">
                  <label for="exampleFormControlInput1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="hdjueuweE5dk@s/" value="">
              </div>
  
              <button type="submit" value="Login" class="btn btn-primary custom-btn" id="updateinfos">Update</button>
  
            </div>

          </div>

        </div>

        <!-- End of user info div -->

        <div class="profile-picture" id="profile-picture">

          <h3>Set profile picture</h3>

          <div class="picture-upload d-flex flex-column flex-wrap">
            <div class="mb-3">
              <label for="formFile" class="form-label">Choose your preferred image</label>
              <input class="form-control" type="file" name="files[]" accept="image/jpeg, image/png, image/jpg" id="uploaded">
            </div>
            <img src="../assets/avatar.png" class="img-thumbnail pdp" alt="profile_picture" id="pdp">
            <button type="submit" value="Login" class="btn btn-primary custom-btn" id="setpicture">Set Picture</button>
          </div>
        </div>

        <!-- End of profile picture upload div -->

          <div class="notifications" id="notifications"> 
              <h3>Activate/Deactivate Notifications</h3>

              <div class="check">
              <p>Activate/Deactivate Email Notifications</p>
              <p>Current status:  <span>Active</span></p>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-outline-primary" id="activate">Activate</button>
                  <button type="button" class="btn btn-outline-primary" id="deactivate">Deactivate</button>
                </div>
              </div>
          </div>
        </div>
        
        <!-- End of notifications upload div -->
      
      </div>
    </div>
</body>
</html>