<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require '../../koneksi_data.php';

if (isset($_POST['beli'])) {
    // Validasi jika nama pelanggan kosong
    if (empty($_POST['pelanggan'])) {
        echo "<script>
            window.alert('Pilih pelanggan terlebih dahulu.');
            window.location.href = 'penjualan.php';
        </script>";
        exit;
    }

    // Validasi jika tidak ada barang yang dipilih
    if (empty($_POST['barang'])) {
        echo "<script>
            window.alert('Pilih barang terlebih dahulu.');
            window.location.href = 'penjualan.php';
        </script>";
        exit;
    }

    // Validasi jika tidak ada jumlah barang yang ditentukan (array quantity) tidak sesuai panjangnya dengan barang (array barang)
    if (empty($_POST['quantity']) || count($_POST['barang']) != count($_POST['quantity']) || !array_filter($_POST['quantity'])) {
        echo "<script>
            window.alert('Tentukan jumlah barang dan Tambahkan barang terlebih dahulu.');
            window.location.href = 'penjualan.php'
        </script>";
        exit;
    }

    // Fetch data dari form
    $id_pelanggan = $_POST['pelanggan'];
    $tanggal = date('Y-m-d');
    $total_harga = 0; // Total harga anu ceuk urang di set 0 sep (ieu bisa di ganti ngke lamun gs aya data harga na)

    // Insert data penjualan ke database
    $query = "INSERT INTO penjualan (id_pelanggan, tanggal, total_harga) VALUES (?, ?, ?)";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, 'iss', $id_pelanggan, $tanggal, $total_harga);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        // Jika berhasil disimpan, ambil id penjualan terbaru
        $id_penjualan = mysqli_insert_id($conn);

        // Nyimpen detail barang anu dibeli ke dalam tabel penjualan_detail
        $barang_dibeli = $_POST['barang'];
        $quantity = $_POST['quantity'];
        foreach ($barang_dibeli as $key => $id_barang) {
            // Cek elemen `quantity` aya dina indeks $key dan henteu kosong
            if (!isset($quantity[$key]) || empty($quantity[$key])) {
                echo "<script>
                    window.alert('Jumlah barang tidak boleh kosong.');
                    window.location.href = 'penjualan.php';
                </script>";
                exit;
            }

            $jumlah = $quantity[$key]; // Mengambil jumlah barang yang sesuai dengan barang yang dipilih dalam array $_POST['quantity']

            // Insert data ke tabel penjualan_detail
            $query_detail = "INSERT INTO penjualan_detail (id_penjualan, id_barang, jumlah, harga) VALUES (?, ?, ?, 0)";
            $statement_detail = mysqli_prepare($conn, $query_detail);
            mysqli_stmt_bind_param($statement_detail, 'iii', $id_penjualan, $id_barang, $jumlah);
            $result_detail = mysqli_stmt_execute($statement_detail);

            if (!$result_detail) {
                echo "<script>
                    window.alert('Terjadi kesalahan saat menyimpan detail penjualan.');
                    window.location.href = 'penjualan.php';
                </script>";
                exit;
            }
            // Update stok barang di tabel stock
            $query_update_stock = "UPDATE stock SET stock = stock - ? WHERE idbarang = ?";
            $stmt_update_stock = mysqli_prepare($conn, $query_update_stock);
            mysqli_stmt_bind_param($stmt_update_stock, 'ii', $jumlah, $id_barang);
            $result_update_stock = mysqli_stmt_execute($stmt_update_stock);

            if (!$result_update_stock) {
                echo "<script>
                    window.alert('Terjadi kesalahan saat memperbarui stok barang.');
                    window.location.href = 'penjualan.php';
                </script>";
                exit;
            }
        }

        echo "<script>
            window.alert('Transaksi berhasil!');
            window.location.href = 'penjualan.php';
        </script>";
    } else {
        echo "<script>
            window.alert('Transaksi gagal!');
            window.location.href = 'penjualan.php';
        </script>";
    }
}
