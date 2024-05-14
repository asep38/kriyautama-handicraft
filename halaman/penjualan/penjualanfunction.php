<?php
require '../../koneksi_data.php';

if (isset($_POST["beli"])) {

    // Tangkap data yang dikirimkan dari formulir
    // $idpelanggan = $_POST['idpelanggan'];
    // $jumlah = $_POST['jumlah'];
    // $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $judulBuku = $_POST['judulBuku'];

    // Validasi data
    if (empty($idpelanggan)) {
        echo "Silakan lengkapi semua data yang diperlukan";
    } else {

        $query = "INSERT INTO `penjualan`(`id_pelanggan`,`tanggal`, `total_harga`) VALUES ('$idpelanggan', '$total_harga')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Ambil ID peminjaman terbaru
            $idpenjualan = mysqli_insert_id($koneksi);

            foreach ($namabarang as $idbarang) {
                if ($idbarang == $namabarang[0]) {
                    continue;
                }
                $queryDetail = "INSERT INTO `penjualan_detail`(`id_penjualan`, `idbarang`, `jumlah`, `harga`) VALUES ('$idbarang', '$jumlah','$harga')";
                $resultDetail = mysqli_query($koneksi, $queryDetail);
            }

            if ($resultDetail) {
                echo "
                    <script>
                        alert('Pembelian berhasil')
                        window.location.href = 'penjualan.php'
                    </script>
                ";
            } else {
                echo "Gagal menyimpan detail barang yang dibeli";
            }
        } else {
            echo "Gagal menyimpan data pembeli";
        }
    }
}
?>