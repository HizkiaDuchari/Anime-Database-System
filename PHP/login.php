<?php 
    session_start();
    $_SESSION["login"] = false;
   
    require 'functions.php';

    //cek ada cookie ato tidak
    if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
        $id = $_COOKIE["id"];
        $key = $_COOKIE["key"];

        //ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if($key === hash("sha256", $row["username"])){
            $_SESSION["login"] = true;
        }

    }

    if($_SESSION["login"]){
        header("Location: index.php");
        exit;
    }


    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        

        //cek usernameny
        if(mysqli_num_rows($result) === 1){
            //cek passwordny
            $row = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $row["password"])) {
                //set session
                $_SESSION["login"] = true;

                //cek remember me
                if (isset($_POST["remember"])) {
                    //buat cookienya

                    setcookie("id", $row["id"], time() + 60);
                    setcookie("key", hash("sha256", $row["username"]), time() + 60);
                }

                header("Location: index.php");
                exit;
            }
        }

        $error = true;

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">username or password is incorrect! </p>
    <?php endif; ?>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" autofocus>
            </li>
            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
            <li>
                <p><a href="./registration.php">Register here</a></p>
            </li>
        </ul>

    </form>


</body>
</html>