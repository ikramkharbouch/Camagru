<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Camagru</title>
    <link rel="icon" href="./assets/Camagru-favicon.png" />
    <link rel="stylesheet" href="styles/main.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Raleway&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <?php include './components/header.html'; ?>

    <div class="container-fluid vh-100">
      <div class="d-flex flex-wrap justify-content-around align-items-center">
        <div class="">
          <img
            src="assets/selfie.svg"
            class="img-fluid one"
            alt="Responsive image"
          />
        </div>

        <div class="mt-5 mb-5 content">
          <div class="text">
            <h2>SHARE YOUR MOMENTS</h2>
            <h1>EDIT AND POST YOUR PICTURES</h1>
          </div>
          <a class="btn btn-primary" href="forms/signup.php" role="button"
            >Get started</a
          >
        </div>

        <div class="">
          <img
            src="assets/organize-photos.svg"
            class="img-fluid two"
            alt="Responsive image"
          />
        </div>
      </div>
    </div>
    <?php include './components/footer.html'; ?>
  </body>
</html>