<?php
require '../../koneksi_data.php';


// ========== barang masuk start ========== //
// menambah barang masuk
if(isset($_POST['tambahbarangmasuk'])){
    $barang = $_POST['barang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barang'");
    $ambildata = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildata['stock'];
    $tambahstokdenganquantity = $stoksekarang + $qty;

    $addtomasuk = mysqli_query($conn,"INSERT INTO masuk (idbarang, keterangan, qty) VALUES('$barang','$penerima','$qty')");
    $updatestokmasuk = mysqli_query($conn,"UPDATE stock SET stock='$tambahstokdenganquantity' WHERE idbarang='$barang'");
    if($addtomasuk && $updatestokmasuk){
        header('location:barangmasuk.php');
    } else {
        echo 'gagal';
        header('location:barangmasuk.php');
    }
}

// edit data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
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