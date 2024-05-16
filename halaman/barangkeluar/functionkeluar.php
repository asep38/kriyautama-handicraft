<?php
require '../../koneksi_data.php';


// menambah barang keluar
if (isset($_POST['tambahbarangkeluar'])) {
    $barang = $_POST['barang'];
    $pelanggan = $_POST['pelanggan'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barang'");
    $ambildata = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildata['stock'];

    if ($stoksekarang >= $qty) {
        // kalau stok barang cukup
        $tambahstokdenganquantity = $stoksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (`idbarang`, `idpelanggan`, `qty`) VALUES('$barang','$pelanggan','$qty')");
        $updatestokkeluar = mysqli_query($conn, "UPDATE stock SET stock='$tambahstokdenganquantity' WHERE idbarang='$barang'");
        if ($addtokeluar && $updatestokkeluar) {
            header('location:barangkeluar.php');
        } else {
            echo 'gagal';
            header('location:barangkeluar.php');
        }
    } else {
        // kalau stok barang ga cukup
        echo '
        <script>
            alert("Stok saat ini tidak mencukupi");
            window.location.href="barangkeluar.php";
        </script>
        ';
    }
}

// edit data barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $pelanggan = $_POST['pelanggan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "SELECT * FROM keluar WHERE idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', idpelanggan='$pelanggan' WHERE idkeluar='$idk'");

        if ($kurangistocknya && $updatenya) {
            header('location:barangkeluar.php');
        } else {
            echo 'Gagal';
            header('location:barangkeluar.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', idpelanggan='$pelanggan' WHERE idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:barangkeluar.php');
        } else {
            echo 'Gagal';
            header('location:barangkeluar.php');
        }
    }
}

// menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idk = $_POST['idkeluar'];

    $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");

    if ($update && $hapusdata) {
        header('location:barangkeluar.php');
    } else {
        header('location:barangkeluar.php');
    }
}
?>