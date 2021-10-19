<?php 
    //koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "phpdasar");

    //ambil data dari tabel mahasiswa
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa");

    // var_dump($result);
    // if(!$result){
    //     echo mysqli_error($conn);
    // }

    //ambil data (fetch) mahasiswa dari object result
    //Ada 4 cara:
    //mysqli_fetch_row() //mengembalikan array numerik (array yg indexnya angka)
    //mysqli_fetch_assoc() //mengembalikan array associative (array yg indexnya key)
    //mysqli_fetch_array() //mengembalikan array numerik dan associative (fleksibel tp makan tempat karena datanya double)
    //mysqli_fetch_object() //mengembalikan object (jarang sekali dipakai)

    //tampilkan semua isi table
    // while ($mhs = mysqli_fetch_assoc($result)) {
    //     var_dump($mhs["name"]);
    // }

    

    


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Character List</h1>

    <table border="1" cellpadding="15" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Action</th>
            <th>Image</th>
            <th>NRP</th>
            <th>Name</th>
            <th>Email</th>
            <th>Major</th>
        </tr>
        <?php $ctr = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $ctr; ?></td>
            <td>
                <a href="">Edit</a> |
                <a href="">Delete</a>
            </td>
            <td><img src="../Assets/<?php echo $row["image"] ?>" alt="" width="175" height="210"></td>
            <td><?php echo $row["nrp"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["major"] ?></td>
        </tr>
        <?php $ctr++; ?>
        <?php endwhile; ?>

    </table>


</body>
</html>