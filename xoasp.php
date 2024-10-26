<?php
    session_start();
    ob_start();
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        if(isset($_SESSION['cart'][$id])){
            unset ($_SESSION['cart'][$id]);
        }

        if (empty ($_SESSION['cart'])){
            unset ($_SESSION['cart']);
        }
    }
    header("Location: giohang.php");
    exit();
?>