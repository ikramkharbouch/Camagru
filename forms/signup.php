<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include '../config/database.php';
    
    // User Input

    $data = array(
        "email" => test_input($_POST['email']),
        "username" => test_input($_POST['username']),
        "pass" => test_input($_POST['password']),
    );

    // VALIDATE INPUT

    $filters = array(
        "email" => FILTER_VALIDATE_EMAIL,
        "username" => array(
            "filter" => FILTER_CALLBACK,
            "options" => "ucwords"
        ),
        "pass" => array(
            "filter" => FILTER_VALIDATE_REGEXP,
            "options" => array(
                "regexp" => "/^[a-z-0-9]+/i"
            ),
        )
    );

    $results = filter_var_array($data, $filters);

    foreach ($results as $key => $value) {
        if (empty($value)) {
            $error = 1;
            echo "Error in ". $key . " input.";
            break;
        }
    }

    //  CHECK BEFORE INSERTING

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$data['username']]);
    $userCount = $stmt->rowCount();

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$data['email']]);
    $emailCount = $stmt->rowCount();

    if ($userCount != 0 || $emailCount != 0) {
        echo "This username or email are already used";
    }
    else if ($userCount == 0 && $error == 0) {
         // INSERT DATA
        mail('camagru@support.com', 'Verification email', 'Activate your account please in this url', 'From: info@societe.com');
        $sql = 'INSERT INTO users(email, username, pass) VALUES(:email, :username, :pass)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo 'Post Added';
    }
    
    $pdo = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="../styles/sign.css">
    <link rel="icon" href="../assets/Camagru-favicon.png" />
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
                        <input type="text" name="username" class="form-control" placeholder="Enter your username">
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