<?php
require '../../koneksi_data.php';

// ========== barang masuk start ========== //
// menambah barang masuk
if (isset($_POST['tambah'])) {
    $pengrajin = $_POST['namapengrajinbaru'];
    $telepon = $_POST['teleponbaru'];
    $alamat = $_POST['alamatbaru'];

    $addtopengrajin = mysqli_query($conn, "INSERT INTO `pengrajin`(`nama`, `alamat`, `NoTelepon`) VALUES ('$pengrajin','$alamat','$telepon')");
    if ($addtopengrajin) {
        header('location:pengrajin.php');
    } else {
        echo 'gagal';
        header('location:pengrajin.php');
    }
}


// edit
if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $idpengrajin = $_POST['idpengrajin'];

    $editdata = mysqli_query($conn, "UPDATE `pengrajin` SET `nama`='$nama',`alamat`='$alamat',`NoTelepon`='$telepon' WHERE idpengrajin='$idpengrajin'");

    if ($editdata) {
        header('location:pengrajin.php');
    } else {
        header('location:pengrajin.php');
    }
}
// menghapus barang masuk
if (isset($_POST['hapus'])) {
    $nama = $_POST['namaarang'];
    $qty = $_POST['qty'];
    $idpengrajin = $_POST['idpengrajin'];

    $hapusdata = mysqli_query($conn, "DELETE FROM pengrajin WHERE idpengrajin='$idpengrajin'");

    if ($hapusdata) {
        header('location:pengrajin.php');
    } else {
        header('location:pengrajin.php');
    }
}
?>