<?php 
    require 'functions.php';

    if(isset($_POST["register"])){
        if (register($_POST) > 0) {
            echo "<script>
                    alert('Registration Success.');
                    </script>";
        }else {
            echo mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../CSS/decor.css">
</head>
<body>
    <h1>Registration Page</h1>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="confirmPassword">Confirm Password: </label>
                <input type="password" name="confirmPassword" id="confirmPassword">
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
            <li>
                <p><a href="./login.php">Login now</a></p>
            </li>
        </ul>


    </form>
    
</body>
</html>