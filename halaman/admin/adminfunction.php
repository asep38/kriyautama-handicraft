<?php
require '../../koneksi_data.php';

// tambah admin
if(isset($_POST['tambahadmin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryinsert = mysqli_query($conn,"INSERT INTO `login` (email, password) VALUES ('$email','$password')");

    if($queryinsert){
        // jika berhasil
        header('location:admin.php');

    } else {
        // jika gagal
        header('location:admin.php');
    }
}

// edit admin
if(isset($_POST['updateadmin'])){
    $emailbaru = $_POST['emailbaru'];
    $passwordbaru = $_POST['passwordbaru'];
    $idnya = $_POST['id'];

    $queryupdate = mysqli_query($conn,"UPDATE `login` SET email='$emailbaru', password='$passwordbaru' where iduser='$idnya'");

    if($queryupdate){
        // jika berhasil
        header('location:admin.php');
    } else {
        // jika gagal
        header('location:admin.php');
    }
}

// hapus admin
if(isset($_POST['hapusadmin'])){
    $id = $_POST['id'];

    $querydelete = mysqli_query($conn,"DELETE FROM `login` WHERE iduser='$id'");

    if($querydelete){
        // jika berhasil
        header('location:admin.php');
    } else {
        // jika gagal
        header('location:admin.php');
    }
}

?>