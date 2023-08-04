<?php
require '../../controller/connection.php';
require '../../controller/auth-user.php';
require '../../controller/barang-jenis.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <title>Stok Obat</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- <nav class="min-height-300 bg-gradient-one position-absolute w-100"></nav> -->
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-one sidebar sidebar-dark accordion " id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Invomas</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <br>
            <div class="sidebar-heading">
                Dashboard
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Input Jenis Barang
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="stokbarang.php">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Stok Obat</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Input Jumlah Data
            </div>

            <!-- Nav Item - Barang Masuk -->
            <li class="nav-item">
                <a class="nav-link" href="masuk.php">
                    <i class="fas fa-fw fa-arrow-circle-down"></i>
                    <span>Obat Masuk</span></a>
            </li>

            <!-- Nav Item - Barang keluar -->
            <li class="nav-item">
                <a class="nav-link" href="keluar.php">
                    <i class="fas fa-fw fa-arrow-circle-up"></i>
                    <span>Obat Keluar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Akun
            </div>
            <!-- Nav Item - akun -->
            <li class="nav-item">
                <a class="nav-link" href="akun.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="<?= BASEURL ?>/controller/process-logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
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


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mt-4 mb-0 text-gray-800">Stok Obat</h1>
                        <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">Tambah Jenis obat</button>

                    </div>

                    <div class="container-fluid">


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Stok Obat</h6>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Merk</th>
                                                <th>Ukuran Dosis</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Stok Expired</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            $ambilsemuadatastock = mysqli_query($conn, "select * from users a
                                            INNER join users_stock b
                                            on a.id_user = b.id_user
                                        
                                            INNER join stock_barang c
                                            on b.id_barang = c.id_barang
                                            where a.username = '$username'
                                            ");

                                            error_reporting(E_ERROR);
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)) {

                                                $namabarang = $data['nama_barang'];
                                                $merkbarang = $data['merk_barang'];
                                                $ukuranbarang = $data['ukuran_barang'];
                                                $deskripsi = $data['deskripsi_barang'];
                                                $satuan = $data['satuan_barang'];
                                                $idb = $data['id_barang'];

                                                $hitungbarangexpired = mysqli_query($conn, "select id_barang, sum(jumlah) as stok from masuk 

                                                where id_barang = '$idb' and is_expired = 1
                                                GROUP BY id_barang");

                                                $fetchexpired = mysqli_fetch_assoc($hitungbarangexpired);

                                                $hitungbarang = mysqli_query($conn, "select id_barang, sum(jumlah) as stok from masuk 

                                                where id_barang = '$idb' and is_expired = 0
                                                GROUP BY id_barang");

                                                $fetchbarang = mysqli_fetch_assoc($hitungbarang);

                                                $hitungbarangkeluar = mysqli_query($conn, "select id_barang, sum(jumlah) as stokkeluar from keluar 

                                                where id_barang = '$idb'
                                                GROUP BY id_barang");

                                                $fetchkeluar = mysqli_fetch_assoc($hitungbarangkeluar);






                                            ?>


                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $namabarang ?></td>
                                                    <td><?= $merkbarang ?></td>
                                                    <td><?= $ukuranbarang ?></td>
                                                    <td><?= $deskripsi ?></td>
                                                    <td><?= $fetchbarang['stok'] - $fetchkeluar['stokkeluar'] ?: 0; ?>&nbsp;<?= $satuan ?></td>
                                                    <td><?= $fetchexpired['stok'] ?: 0; ?>&nbsp;<?= $satuan ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idb; ?>">Edit</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $idb; ?>">Hapus</button>
                                                    </td>
                                                </tr>
                                                <!--modal edit-->
                                                <div class="modal fade" id="edit<?= $idb; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Obat</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    <h7>Nama Obat</h7>
                                                                    <input type="text" name="namabarang" value="<?= $namabarang; ?>" placeholder="Nama Obat" class="form-control" required>
                                                                    <br>
                                                                    <h7>Merk Obat</h7>
                                                                    <input type="text" name="merkbarang" value="<?= $merkbarang; ?>" placeholder="Merk Obat" class="form-control" required>
                                                                    <br>
                                                                    <h7>Ukuran Dosis Obat</h7>
                                                                    <input type="text" name="ukuranbarang" value="<?= $ukuranbarang; ?>" placeholder="Ukuran Dosis Obat" class="form-control" required>
                                                                    <br>
                                                                    <h7>Deskripsi Obat</h7>
                                                                    <input type="text" name="deskripsibarang" value="<?= $deskripsi; ?>" placeholder="Deskripsi Obat" class="form-control" required>
                                                                    <br>
                                                                    <h7>Satuan Obat</h7>
                                                                    <input type="text" name="satuanbarang" value="<?= $satuan; ?>" placeholder="Satuan Obat" class="form-control" required>
                                                                    <input type="hidden" name="idb" value="<?= $idb ?>">


                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!--modal delete-->
                                                <div class="modal fade" id="hapus<?= $idb; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Obat</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form method="post">
                                                                <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus Data <?= $namabarang; ?>&nbsp;<?=$merkbarang?>&nbsp;<?=$ukuranbarang?>&nbsp;<?=$deskripsi?>?
                                                                    <br>
                                                                    <input type="hidden" name="idb" value="<?= $idb ?>">

                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>



                                            <?php
                                            };
                                            ?>
                                        </tbody>


                                    </table>

                                    <a href="exportstock.php" class="btn btn-info">Export data</a>
                                </div>
                            </div>
                        </div>


                    </div>



                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy;  2021</span>
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


            <!-- Bootstrap core JavaScript-->
            <script src="../../assets/vendor/jquery/jquery.min.js"></script>
            <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../../assets/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../../assets/js/demo/chart-area-demo.js"></script>
            <script src="../../assets/js/demo/chart-pie-demo.js"></script>

            <!-- Data Table-->
            <script>
                $(document).ready(function() {
                    $('#table').DataTable();
                });
            </script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>


</body>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Obat" class="form-control" required>
                    <br>
                    <input type="text" name="merkbarang" placeholder="Merk Obat" class="form-control" required>
                    <br>
                    <input type="text" name="ukuranbarang" placeholder="Ukuran Dosis Obat" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsibarang" placeholder="Deskripsi Obat" class="form-control" required>
                    <br>
                    <input type="text" name="satuanbarang" placeholder="Satuan Barang" class="form-control" required>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>