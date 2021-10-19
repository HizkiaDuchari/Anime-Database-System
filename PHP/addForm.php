<?php
    session_start();

    if(!$_SESSION["login"]){
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    if(isset($_POST["submit"])){
        //cek apakah data berhasil ditambah atau tdk
        if (addList($_POST) > 0) {
            echo "
                <script>
                    alert('Character added to the list!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else {
            echo "
                <script>
                    alert('Error while adding character to the list!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add character list</title>
    <link rel="stylesheet" href="../CSS/decor.css">
</head>
<body>
    <h1>Add character list</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nrp">NRP: </label> <!-- for pasangannya sm id  -->
                <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
                <label for="name">Name: </label>
                <input type="text" name="name" id="name" required>
            </li>
            <li>
                <label for="Position">Position: </label>
                <input type="text" name="position" id="position" required>
            </li>
            <li>
                <label for="cursedTechnique">Cursed Technique: </label>
                <input type="text" name="cursedTechnique" id="cursedTechnique" required>
            </li>
            <li>
                <label for="image">Image: </label>
                <input type="file" name="image" id="image">
            </li>
            <li>
                <button type="submit" name="submit">Add character</button>
            </li>
        </ul>

    </form>

    <a href="index.php">Back to character list</a>

</body>
</html>