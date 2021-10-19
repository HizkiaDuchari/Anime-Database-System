<?php
    session_start();

    if(!$_SESSION["login"]){
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    
    //ambil data di URL
    $id = $_GET["id"];

    //query data mahasiswa berdasarkan id
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
    // var_dump($mhs);
    
    if(isset($_POST["submit"])){
        //cek apakah data berhasil diubah atau tdk
        if (editList($_POST) > 0) {
            echo "
                <script>
                    alert('Character edited successfully!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else {
            echo "
                <script>
                    alert('Error editing the character list!');
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
    <title>Edit character list</title>
    <link rel="stylesheet" href="../CSS/decor.css">
</head>
<body>
    <h1>Edit character list</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
        <input type="hidden" name="oldImage" value="<?php echo $mhs["image"]; ?>">
        <ul>
            <li>
                <label for="nrp">NRP: </label> <!-- for pasangannya sm id  -->
                <input type="text" name="nrp" id="nrp" required value="<?php echo $mhs["nrp"] ?>">
            </li>
            <li>
                <label for="name">Name: </label>
                <input type="text" name="name" id="name" required value="<?php echo $mhs["name"] ?>">
            </li>
            <li>
                <label for="position">Email: </label>
                <input type="text" name="position" id="position" required value="<?php echo $mhs["position"] ?>">
            </li>
            <li>
                <label for="cursedTechnique">Major: </label>
                <input type="text" name="cursedTechnique" id="cursedTechnique" required value="<?php echo $mhs["cursedTechnique"] ?>">
            </li>
            <li class="imgForm">
                <label for="image">Image: </label>
                <img src="../../Assets/<?php echo $mhs["image"] ?>" alt="">
                <input type="file" name="image" id="image">
            </li>
            <li>
                <button type="submit" name="submit">Confirm Edit</button>
            </li>
        </ul>

    </form>

    <a href="index.php">Back to character list</a>

</body>
</html>
