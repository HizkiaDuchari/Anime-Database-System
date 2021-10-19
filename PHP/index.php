<?php 
    session_start();
    // session_destroy();
    // var_dump($_SESSION["login"]);
    // var_dump($_SESSION["login"]);

    if (!$_SESSION["login"]) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    //pagination
    $listPerPage = 5;
    $totalCharacter = count(query("SELECT * FROM mahasiswa"));
    $totalPage = ceil($totalCharacter / $listPerPage);
    // var_dump($totalPage);
    $currentPage = (isset($_GET["currentPage"]) ? $_GET["currentPage"] : 1);

    $dataStart = ($currentPage - 1) * $listPerPage;

    $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $dataStart, $listPerPage");

    //kalo tombol cari udh pernah diklik
    if(isset($_POST["searchBtn"])){
        $mahasiswa = search($_POST["keyword"]);

    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <a href="logout.php">Logout</a>
    <div class="header">
        <h1>Jujutsu Kaisen Character List</h1>
    </div>
    
    <div class="content">
        <div id="addButton">
            <a href="addForm.php">Add character +</a>
        </div>
        <div id="search">
            <form action="" method="POST">
                <input type="text" name="keyword" id="keyword" size="30" autofocus placeholder="Search" autocomplete="off">
                <button type="submit" name="searchBtn">Search</button>
            </form>
        </div>
        <div class="pageList">
            <?php if($currentPage > 1) : ?>
                <a href="?currentPage=<?php echo $currentPage - 1 ?>">&lt;</a>
            <?php endif; ?>
            <?php for ($i=1; $i <= $totalPage; $i++) : ?>
                <?php if($i == $currentPage) : ?>
                    <a href="?currentPage=<?php echo $i ?>" style="color: red;"><?php echo $i ?></a>
                <?php else : ?>
                    <a href="?currentPage=<?php echo $i ?>"><?php echo $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if($currentPage < $totalPage) : ?>
                <a href="?currentPage=<?php echo $currentPage + 1 ?>">&gt;</a>
            <?php endif; ?>
        </div>
        <div id="table">
            <table border="1" cellpadding="15" cellspacing="0">
            <tr id="attribute">
                <th>No.</th>
                <th>Action</th>
                <th>Image</th>
                <th>Character Code</th>
                <th>Name</th>
                <th>Position</th>
                <th>Cursed Technique</th>
            </tr>
            <?php $ctr = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
            <tr id="charList">
                <td><?php echo $ctr; ?></td>
                <td>
                    <a href="editForm.php?id=<?php echo $row["id"] ?>">Edit</a> |
                    <a href="deleteForm.php?id=<?php echo $row["id"] ?>">Delete</a>
                </td>
                <td><img src="../Assets/<?php echo $row["image"] ?>" alt="" width="175" height="210"></td>
                <td><?php echo $row["nrp"] ?></td>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["position"] ?></td>
                <td><?php echo $row["cursedTechnique"] ?></td>
            </tr>
            <?php $ctr++; ?>
            <?php endforeach; ?>
            </table>
        </div>

        
    </div>
    <div class="footer">

    </div>


</body>
</html>