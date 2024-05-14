<?php 
require '../../koneksi_data.php';

// =============== BARANG/produk ================ //
// menambah Produk
if(isset($_POST['tambahproduk'])){
    $idbarang = $_POST['idbarang'];
    $barang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $deskripsi = $_POST['deskripsi'];

    $produk = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idbarang'");
    $ambildata = mysqli_fetch_array($produk);

    

    $addToProduk = mysqli_query($conn,"INSERT INTO stock (`namabarang`, `stock`, `deskripsi`) VALUES ('$barang', '$stock', '$deskripsi')");
    // $updatePo = mysqli_query($conn,"update stock set stock='$tambahstokdenganquantity' where idbarang='$barang'");
    if($addToPo){
        header('location:stokbarang.php');
    } else {
        echo 'gagal';
        header('location:stokbarang.php');
    }
}

// edit produk
if(isset($_POST['editproduk'])){
    $idbarang = $_POST['idbarang'];

    $barang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "UPDATE stock SET namabarang='$barang', stock='$stock', deskripsi='$deskripsi' WHERE idbarang='$idbarang'");

    if($update){
        header('location:stokbarang.php');
    } else {
        echo 'gagal';
        header('location:stokbarang.php');
    }
}

// hapus Produk
if(isset($_POST['hapusproduk'])){
    $idbarang = $_POST['idbarang'];

    $hapus = mysqli_query($conn,"DELETE FROM `stock` WHERE idbarang='$idbarang'");
    if($hapus){
        header('location:stokbarang.php');
    } else {
        echo 'gagal';
        header('location:stokbarang.php');
    }
}

?>