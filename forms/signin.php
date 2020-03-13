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
    <?php include '../components/header.html'; ?>

    <div class="container-1">
        <div class="illustration">
            <img class="img-fluid" src="../assets/group.svg" alt="Responsive image">
        </div>
        <div class="two">
            <div class="form d-flex flex-column align-items-center mt-5">
                <div class="caption pt-5">
                    <h1 class="text-center">Welcome Back!</h1>
                    <h5 class="text-center">Join a community of over 1 million people<br />
                        all sharing and growing the feed.</h5>
                </div>
                <form method="POST" class="login-form">
                    <div class="form-group pt-5">
                        <input type="text" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    </div>
                    <div class="custom-control custom-checkbox pt-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                        <label class="remember custom-control-label" for="customCheck1">Remember your password</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../components/footer.html'; ?>
</body>

</html>
