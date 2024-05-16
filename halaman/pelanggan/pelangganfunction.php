<?php
require '../../koneksi_data.php';

// ========== barang masuk start ========== //
// menambah barang masuk
if (isset($_POST['tambah'])) {
    $pelanggan = $_POST['namabaru'];
    $telepon = $_POST['teleponbaru'];
    $alamat = $_POST['alamatbaru'];

    $addtopelanggan = mysqli_query($conn, "INSERT INTO `pelanggan`(`namapelanggan`, `alamat`, `notelpn`) VALUES ('$pelanggan','$alamat','$telepon')");
    if ($addtopelanggan) {
        header('location:pelanggan.php');
    } else {
        echo 'gagal';
        header('location:pelanggan.php');
    }
}


// edit
if (isset($_POST['edit'])) {
    $nama = $_POST['pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $idpelanggan = $_POST['idpelanggan'];

    $editdata = mysqli_query($conn, "UPDATE `pelanggan` SET `namapelanggan`='$nama',`alamat`='$alamat',`notelpn`='$telepon' WHERE idpelanggan='$idpelanggan'");

    if ($editdata) {
        header('location:pelanggan.php');
    } else {
        header('location:pelanggan.php');
    }
}
// menghapus barang masuk
if (isset($_POST['hapus'])) {
    $nama = $_POST['namaarang'];
    // $qty = $_POST['qty'];
    $idpelanggan = $_POST['idpelanggan'];

    $hapusdata = mysqli_query($conn, "DELETE FROM pelanggan WHERE idpelanggan='$idpelanggan'");

    if ($hapusdata) {
        header('location:pelanggan.php');
    } else {
        header('location:pelanggan.php');
    }
}
?>