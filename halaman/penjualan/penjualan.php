<?php
require "penjualanfunction.php";

// require '../../cek.php';
$q = mysqli_query($conn, "SELECT * FROM pelanggan");
$barang = mysqli_query($conn, "SELECT * FROM stock");


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kriya Utama - Penjualan</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Kriya Utama </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Halaman
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../stokbarang/stokbarang.php">
                    <span>Stok Barang</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../barangmasuk/barangmasuk.php">
                    <span>Barang Masuk</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../barangkeluar/barangkeluar.php">
                    <span>Barang keluar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../penjualan/penjualan.php">
                    <span>Penjualan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/admin.php">
                    <span>Admin</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../pengrajin/pengrajin.php">
                    <span>Pengrajin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../pelanggan/pelanggan.php">
                    <span>Pelanggan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#logoutModal">
                    <span>Log Out</span>
                </a>

            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>




        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- kontent navbar -->

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Penjualan</h1>

                    </div>



                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area tabel -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">

                                <!-- tabel -->
                                <form action="" method="POST" class="addform" onsubmit="return validateForm()">
                                    <div class="form-container">
                                        <!-- Formulir Tambah Data -->
                                        <div class="form-group">
                                            <label for="pelanggan">Nama Pelanggan:</label>
                                            <select name="pelanggan" id="pelanggan">
                                                <option value="" disabled selected>Pilih pelanggan</option>
                                                <?php foreach ($q as $data) : ?>
                                                    <option value="<?= $data['idpelanggan'] ?>">
                                                        <?= $data['namapelanggan'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="barang">Barang Yang di beli:</label>
                                            <select name="barang" id="barang">
                                                <option value="" disabled selected>Pilih barang</option>
                                                <?php foreach ($barang as $data) : ?>
                                                    <option value="<?= $data['idbarang'] ?>">
                                                        <?= $data['namabarang'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="button" id="tambah_barang" onclick="tambahDataDariInputan()">Tambah Barang</button>
                                        </div>
                                    </div>
                                    <div class="form-container">
                                        <table class="responsive-table" id="tabelData">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </table>
                                        <a href="transaksi.php">
                                            <button type="button">Kembali</button>
                                        </a>
                                        <button type="submit" name="beli">Beli Barang</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Asep Zarkasih Noor 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal PO -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form method="post">

                        <div class="form-group">
                            <!-- nama barang -->
                            <select name="barang" class="form-control">
                                <?php

                                $ambilsemuabarang = mysqli_query($conn, "SELECT * FROM stock");
                                while ($fetcharray = mysqli_fetch_array($ambilsemuabarang)) {
                                    $namabarangnya = $fetcharray['namabarang'];
                                    $idbarangnya = $fetcharray['idbarang'];

                                ?>

                                    <option value="<?= $idbarangnya; ?>">
                                        <?= $namabarangnya; ?>
                                    </option>

                                <?php
                                }
                                ?>

                            </select>

                        </div>

                        <div class="form-group">
                            <input type="number" name="qty" id="qty" placeholder="Quantity" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="penerima" id="penerima" placeholder="Penerima" class="form-control" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="tambahbarangkeluar">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

    <!-- js custom -->
    <script>
        var noUrut = 1;

        function tambahDataDariInputan() {
            var namaBarang = document.getElementById('barang');
            if (namaBarang) {
                var selectedOption = namaBarang.options[namaBarang.selectedIndex];
                if (selectedOption && selectedOption.value !== 'Pilih barang') {
                    var selectedText = selectedOption.innerHTML;
                    var selectedValue = selectedOption.value;
                    var tabel = document.getElementById('tabelData');
                    var barisBaru = tabel.insertRow();
                    var selNomor = barisBaru.insertCell(0);
                    var selBarang = barisBaru.insertCell(1);
                    var selJumlah = barisBaru.insertCell(2);
                    var selAksi = barisBaru.insertCell(3);

                    selNomor.innerHTML = noUrut;
                    selBarang.innerHTML = selectedText + '<input type="hidden" name="barang[]" value="' + selectedValue + '">';
                    selJumlah.innerHTML = '<input type="number" name="quantity[]" value="1" min="1">';
                    selAksi.innerHTML = '<button type="button" onclick="hapusBaris(this)">Hapus</button>';
                    noUrut++;
                } else {
                    alert('Pilih barang terlebih dahulu.');
                }
            }
        }

        function hapusBaris(baris) {
            var row = baris.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function validateForm() {
            var namaBarang = document.getElementById('barang');
            var quantityInputs = document.getElementsByName('quantity[]');
            if (!namaBarang || namaBarang.selectedIndex === 0) {
                alert('Pilih barang terlebih dahulu.');
                return false;
            }
            for (var i = 0; i < quantityInputs.length; i++) {
                if (quantityInputs[i].value === '' || parseInt(quantityInputs[i].value) <= 0) {
                    alert('Tentukan jumlah barang terlebih dahulu.');
                    return false;
                }
            }
            return true;
        }
    </script>
</body>

</html>