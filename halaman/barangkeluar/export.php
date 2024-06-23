<?php
require 'functionkeluar.php';
// require 'cek.php';
?>
<html>

<head>
    <title>Stock Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <style>
        img {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-between mt-4">
        <div>
            <!-- <img src="../../img/logokriya.png" alt=""> -->
        </div>
        <div class="text-center">
            <!-- <p class="uppercase">
                Toko Kerajinan Tangan
            </p> -->
            <h2>
                KRIYA UTAMA NATURAL HANDMADE
            </h2>
            <p>
                Jl. Rajapolah 204, Kec. Rajapolah, Kab. Tasikmalaya, Jawa Barat 46155
            </p>
            <p>
                email: utamakriya@yahoo.com / telp: 081261619094
            </p>
            <p>
                __________________________________________________________________________________________________________________________________________________
            </p>
        </div>
        <div>
            <!-- <img src="assets/images/logo-smpn1.jpeg" alt=""> -->
        </div>
    </div>

    <div class="container">
        <h5>Laporan Barang Keluar</h5>
        <p>tanggal : </p>
        <button class="print-button border-none" onclick="window.print()">Cetak Halaman</button>
        <div class="data-tables datatable-dark">

            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>tanggal</th>
                        <th>Nama Barang</th>
                        <th>Pelanggan</th>
                        <th>QTY</th>

                    </tr>
                </thead>

                <tbody>

                    <?php
                    $ambilsemuadatastock = mysqli_query($conn, "SELECT 
                    keluar.idkeluar,
                    keluar.idbarang,
                    keluar.tanggal,
                    keluar.idpelanggan,
                    keluar.qty,
                    pelanggan.namapelanggan,
                    stock.namabarang
                     FROM keluar
                     JOIN stock ON keluar.idbarang
                     JOIN pelanggan ON keluar.idpelanggan");
                    $i = 1;
                    while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                        $idkeluar = $data['idkeluar'];
                        $idb = $data['idbarang'];
                        $idpelanggan = $data['idpelanggan'];
                        $qty = $data['qty'];
                        $tanggal = $data['tanggal'];
                        $namabarang = $data['namabarang'];
                        $namapelanggan = $data['namapelanggan'];
                        ?>

                        <tr>
                            <td> <?= $i++; ?> </td>
                            <td> <?php echo $tanggal; ?> </td>
                            <td value="<?php echo $idb; ?> "> <?php echo $namabarang; ?> </td>
                            <td value="<?php echo $idpelanggan; ?>"> <?php echo $namapelanggan; ?> </td>
                            <td> <?php echo $qty; ?> </td>
                        </tr>

                        <?php
                    }
                    ;
                    ?>


                </tbody>
            </table>

        </div>
    </div>

    <script>
        // $(document).ready(function () {
        //     $('#mauexport').DataTable({
        //         dom: 'Bfrtip',
        //         buttons: [
        //             'excel'
        //         ]
        //     });
        // });

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>