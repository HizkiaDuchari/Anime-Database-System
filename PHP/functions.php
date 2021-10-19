<?php 
    //koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "animedb");

    function query($query){
        //ambil data dari tabel mahasiswa
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; 
        }
        return $rows;
    }

    function addList($data){
        global $conn;
        $nrp = htmlspecialchars($data["nrp"]);
        $name = htmlspecialchars($data["name"]);
        $position = htmlspecialchars($data["position"]);
        $cursedTechnique = htmlspecialchars($data["cursedTechnique"]);
        
        //upload gambar
        $image = upload();
        if(!$image){
            return false;
        }

        $query = "INSERT INTO mahasiswa VALUES('', '$name', '$nrp', '$position', '$cursedTechnique', '$image')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);        
    }

    function upload(){
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $error = $_FILES["image"]["error"];
        $tempName = $_FILES["image"]["tmp_name"];

        //cek apakah tidak ada gambar yg diupload
        if($error === 4){
            echo "<script>
                    alert('Please upload an image.');
                    </script>";
            return false;
        }

        //cek yg diupload harus gambar
        $imgValidation = ['jpg', 'jpeg', 'png'];
        $imgExt = explode('.', $fileName);
        $imgExt = strtolower(end($imgExt));
        if (!in_array($imgExt, $imgValidation)) {
            echo "<script>
                    alert('Please upload a file with image extension (jpg, jpeg, or png).');
                    </script>";
            return false;
        }

        //cek limit ukuran file
        if ($fileSize > 1000000) {
            echo "<script>
                    alert('File size is too big!');
                    </script>";
            return false;
        }

        //kalo lolos smua validasi maka generate nama image baru
        //biar user yg beda bisa upload dgn nama file yg sama
        $newFileName = uniqid();
        
        $newFileName .= ".";
        $newFileName .= "$imgExt";
        // var_dump($newFileName); die;

        move_uploaded_file($tempName, '../Assets/' . $newFileName);

        return $newFileName;

    }


    function deleteList($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa where id = $id");
        return mysqli_affected_rows($conn);
    }

    function editList($data){
        global $conn;
        $id = $data["id"];
        $nrp = htmlspecialchars($data["nrp"]);
        $name = htmlspecialchars($data["name"]);
        $position = htmlspecialchars($data["position"]);
        $cursedTechnique = htmlspecialchars($data["cursedTechnique"]);
        $oldImage = htmlspecialchars($data["oldImage"]);

        //cek apakah user upload gambar baru atau tidak
        if($_FILES["image"]["error"] === 4){
            $image = $oldImage;
        }else{
            $image = upload();
        }
        

        $query = "UPDATE mahasiswa SET
                    nrp = '$nrp',
                    name = '$name',
                    position = '$position',
                    cursedTechnique = '$cursedTechnique',
                    image = '$image'
                    WHERE id = $id
        ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);  
    }

    function search($keyword){
        $query = "SELECT * FROM mahasiswa
                    WHERE name LIKE '%$keyword%' or
                    nrp LIKE '%$keyword%' or
                    position LIKE '%$keyword%' or
                    cursedTechnique LIKE '%$keyword%'
        ";
        return query($query);
    }

    function register($data){
        global $conn;

        //karakter slash dihilangkan lalu semua karakter diubah menjadi huruf kecil
        $username = strtolower(stripslashes($data["username"]));
        //biar user bisa masukin password pake symbol-symbol 
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $confirmPasword = mysqli_real_escape_string($conn, $data["confirmPassword"]);

        //cek already existed username
        $validationUsername = mysqli_query($conn, "SELECT username FROM user
                    WHERE username = '$username'");

        if(mysqli_fetch_assoc($validationUsername)){
            echo "<script>
                    alert('Username already existed.');
                    </script>";
            return false;
        }

        //cek konfirmasi password
        if($password != $confirmPasword){
            echo "<script>
                    alert('Confirmation password did not match.');
                    </script>";
            return false;
        }

        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        //tambahkan username baru ke database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }


?>