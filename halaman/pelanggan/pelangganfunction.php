<?php 
require '../../koneksi_data.php';

// ========== barang masuk start ========== //
// menambah barang masuk
if(isset($_POST['tambahbarangmasuk'])){
    $pelanggan = $_POST['pelanggan'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn,"SELECT * FROM pelanggan WHERE idpelanggan='$idpelanggan'");
    $ambildata = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildata['stock'];
    $tambahstokdenganquantity = $stoksekarang + $qty;

    $addtopelanggan = mysqli_query($conn,"INSERT INTO pelanggan (idpelanggan, keterangan, qty) VALUES('$barang','$penerima','$qty')");
    $updatestokpelanggan = mysqli_query($conn,"UPDATE stock SET stock='$tambahstokdenganquantity' WHERE idpelanggan='$barang'");
    if($addtopelanggan && $updatestokpelanggan){
        header('location:barangpelanggan.php');
    } else {
        echo 'gagal';
        header('location:barangpelanggan.php');
    }
}

// edit data barang pelanggan
if(isset($_POST['updatebarangpelanggan'])){
    $idb = $_POST['idbarang'];
    $idm = $_POST['idpelanggan'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn,"SELECT * FROM masuk WHERE idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn,"UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn,"UPDATE masuk SET qty='$qty', keterangan='$deskripsi' WHERE idmasuk='$idm'");
        
        if ($kurangistocknya&&$updatenya){
            header('location:barangmasuk.php');
        } else {
            echo 'Gagal';
            header('location:barangmasuk.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn,"UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn,"UPDATE masuk SET qty='$qty', keterangan='$deskripsi' WHERE idmasuk='$idm'");
        if ($kurangistocknya&&$updatenya){
            header('location:barangmasuk.php');
        } else {
            echo 'Gagal';
            header('location:barangmasuk.php');
        }
    }
}

// menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idm = $_POST['idmasuk'];

    $getdatastock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn,"UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"DELETE FROM masuk WHERE idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:barangmasuk.php');
    } else {
        header('location:barangmasuk.php');
    }
}
?>