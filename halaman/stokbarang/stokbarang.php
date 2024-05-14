<?php 
require 'functionstok.php';
// require '../../cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kriya Utama - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                Interface
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

                    
                   <!-- kontent top bar -->

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Stok Barang</h1>
                       
                    </div>



                    <!-- Content Row / masukan kontent disini -->

                    <div class="row">

                        <!-- Area tabel -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalStok" >Tambah Produk</button>
                                <a href="./export.php" class="btn btn-primary">Cetak Laporan</a>
                                </div>
                                <!-- tabel -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>kode</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                    
                                        <tbody>

                                            <?php
                                            $ambilSemuaData = mysqli_query($conn,"SELECT * FROM `stock`");
                                            while($data=mysqli_fetch_array($ambilSemuaData)){
                                                $idbarang = $data['idbarang'];
                                                $barang = $data['namabarang'];
                                                $stock = $data['stock'];
                                                $deskripsi = $data['deskripsi'];
                                            ?>

                                            <tr>
                                                <td><?=$idbarang;?></td>
                                                <td><?=$barang;?></td>
                                                <td><?=$deskripsi;?></td>
                                                <td><?=$stock;?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ModalEdit<?=$idbarang;?>" >Edit</button>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete<?=$idbarang;?>">delete</button>
                                                </td>
                                                
                                            </tr>

                                            <!-- modal edit -->
                                            <div class="modal fade" id="ModalEdit<?=$idbarang;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <form method="post" >

                                                                
                                                                <div class="form-group">
                                                                    <!-- keterangan barang -->
                                                                    <input type="text" name="namabarang" id="nama-barang" value="<?=$barang;?>" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <!-- keterangan barang -->
                                                                    <input type="number" name="stock" id="stock" value="<?=$stock;?>" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <!-- keterangan barang -->
                                                                    <input type="text" name="deskripsi" id="deskripsi" value="<?=$deskripsi;?>" class="form-control" required>
                                                                </div>
                                                                

                                                                    <input type="hidden" name="idbarang" value="<?=$idbarang;?>" >
                                                                    
                                                                    <!-- tombol submit-->
                                                                    <button type="submit" class="btn btn-primary" name="editproduk">Edit</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal delete -->
                                            <div class="modal fade" id="ModalDelete<?=$idbarang;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <form method="post" action="">

                                                                    Apakah Anda Yakin Ingin Menghapus <?=$barang;?> ?
                                                                    <br>
                                                                    <br>
                                                                    <input type="hidden" name="idbarang" value="<?=$idbarang;?>" >
                                                                   

                                                                    <!-- tombol submit-->
                                                                    <button type="submit" class="btn btn-danger" name="hapusproduk">Hapus</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
        <div class="modal fade" id="ModalStok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post">

                    <?php     
                        $ambilsemuabarang = mysqli_query($conn,"SELECT * FROM `stock`");
                        while($fetcharray = mysqli_fetch_array($ambilsemuabarang)){
                            $idbarang = $fetcharray['idbarang'];
                            $barang = $fetcharray['namabarang'];
                            $stock = $fetcharray['stock'];
                            $deskripsi = $fetcharray['deskripsi'];
                           
                        }  
                    ?>

                
                <div class="form-group">
                    <input type="text" class="form-control" name="namabarang" id="nama-barang" placeholder="Nama Barang" required>
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="stok" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambahproduk">Tambah</button>
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

</body>

</html>