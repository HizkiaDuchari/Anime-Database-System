<?php 
    session_start();

    if(!$_SESSION["login"]){
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    $id = $_GET["id"];
    if(deleteList($id) > 0){
        echo "
                <script>
                    alert('Character deleted from the list!');
                    document.location.href = 'index.php';
                </script>
            ";
    }else{
        echo "
                <script>
                    alert('Error while deleting character from the list!');
                    document.location.href = 'index.php';
                </script>
            ";
    }

?>