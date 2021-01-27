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
    <title>Settings</title>
</head>
<body>
    
</body>
</html>