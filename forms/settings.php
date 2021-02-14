<?php
  require('../init.php');

  if (!isset($_SESSION['auth'])) 
  {
    header("Location: ../404.php");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Camagru</title>
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="../styles/settings.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="../JS/menu.js"></script>
  <script src="../JS/settings.js"></script>
</head>

<body>

  <?php include '../components/menu.html';?>
    <div class="container">
    <p id="success-message"></p>
      <p id="error-message"></p>
      <h1>User settings</h1>
      <div class="second-container d-flex flex-column">
      
      <!-- The left div-->

      <div class="left d-flex flex-column">
        <h3>Informations</h3>
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn" id="userinfos">User Infos</button>
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn" id="setpdp">Set Profile Picture</button>
        <h3>Notifications</h3>
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn" id="notifs">Preferences</button>
      </div>

      <!-- The right div-->

      <div class="right">
        <div class="user-info" id="user-info">
          <h3>Update user info</h3>

          <div class="inputs">
            <div class="credentials">
  
              <div class="mb-3 mt-2">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control" id="user-name" placeholder="Username" value="" required>
              </div>
              <button type="submit" value="Login" class="btn btn-primary custom-btn" id="update-username">Update Username</button>
              <div class="mb-3 email mt-4">
                  <label for="exampleFormControlInput1" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com" value="" required>
              </div>
              <button type="submit" value="Login" class="btn btn-primary custom-btn" id="update-email">Update Email</button>
              <div class="mb-3 password mt-4">
                  <label for="exampleFormControlInput1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="hdjueuweE5dk@s/" value="" required>
              </div>
              <button type="submit" value="Login" class="btn btn-primary custom-btn" id="update-password">Update Password</button>
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
              <p>Current status:  <span></span></p>
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

    <footer style="position: fixed; margin-left: 0;">!Silent corner 1337 2021 Covid-19 ikrkharb</footer>
</body>
</html>