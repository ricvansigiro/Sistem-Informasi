<?php
require_once '../../controller/connection.php';
require_once '../../controller/auth-user.php';
require_once '../../controller/barang-keluar.php';
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

    <title>Keluar</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-one sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <div class="sidebar-brand-text mx-3">invomas</div>
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

            <li class="nav-item">
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
            <li class="nav-item active">
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

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 mt-4 text-gray-800">Obat Keluar</h1>
                        <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">Tambah Obat Keluar</button>
                    </div>

                    <div class="container-fluid">


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Obat Keluar</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Keterangan Penerima</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from users a

                                        INNER join users_keluar b
                                        on a.id_user = b.id_user
                                        
                                        INNER join keluar c
                                        on b.id_keluar = c.id_keluar
                                        
                                        INNER join stock_barang d
                                        on c.id_barang = d.id_barang
                                        
                                        where a.id_user = '$id_user'");

                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['nama_barang'];
                                                $jumlah = $data['jumlah'];
                                                $merkbarang = $data['merk_barang'];
                                                $ukuranbarang = $data['ukuran_barang'];
                                                $keterangan = $data['deskripsi'];
                                                $satuan  = $data['satuan_barang'];
                                                $deskripsi = $data['deskripsi_barang'];
                                                $idk = $data['id_keluar'];
                                                $idb = $data['id_barang'];

                                            ?>


                                                <tr>
                                                    <td><?= $tanggal ?></td>
                                                    <td><?= $namabarang ?>&nbsp;<?= $merkbarang ?>&nbsp;<?= $ukuranbarang ?>&nbsp;<?= $deskripsi ?></td>
                                                    <td><?= $jumlah ?>&nbsp;<?= $satuan ?></td>
                                                    <td><?= $keterangan ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idk; ?>">Edit</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $idk; ?>">Hapus</button>
                                                    </td>
                                                </tr>
                                                <!--modal edit-->
                                                <div class="modal fade" id="edit<?= $idk; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    Edit jumlah <?= $namabarang; ?>
                                                                    <br>
                                                                    <input type="number" name="jumlah" value="<?= $jumlah; ?>" placeholder="Jumlah Obat" class="form-control" required>
                                                                    <br>
                                                                    Keterangan Penerima
                                                                    <input type="text" name="keterangan" value="<?= $keterangan; ?>" placeholder="Keterangan Penerima" class="form-control" required>
                                                                    <input type="hidden" name="idb" value="<?= $idb ?>">
                                                                    <input type="hidden" name="idk" value="<?= $idk ?>">
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--modal delete-->
                                                <div class="modal fade" id="hapus<?= $idk; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    Apakah Anda Yakin Ingin Menghapus Data <?= $namabarang; ?>&nbsp;<?= $merkbarang ?>&nbsp;<?= $ukuranbarang ?>&nbsp;<?= $deskripsi ?>?
                                                                    <br>
                                                                    <input type="hidden" name="idb" value="<?= $idb ?>">
                                                                    <input type="hidden" name="jlh" value="<?= $jumlah ?>">
                                                                    <input type="hidden" name="idk" value="<?= $idk ?>">

                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
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
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exportModalkeluar">Export Excel</button>
                                </div>
                            </div>
                        </div>

                    </div>



                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; 2021</span>
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
                const compareDates = () => {
                    var fromDate = document.getElementById('from').value;
                    var toDate = document.getElementById('to').value;
                    if (toDate >= fromDate) {
                        document.getElementById('btnExport').disabled = false;
                    }
                    if (toDate <= fromDate) {
                        document.getElementById('btnExport').disabled = true;
                    }

                }
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post">
                <div class="modal-body">

                    <select name="barangnya" class="form-control">
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from users a

                        INNER join users_stock b
                            on a.id_user = b.id_user
            
                        INNER join stock_barang c
                         on b.id_barang = c.id_barang
            
                        where a.id_user = '$id_user'");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namabarangnya = $fetcharray['nama_barang'];
                            $merkbarang = $fetcharray['merk_barang'];
                            $ukuranbarang = $fetcharray['ukuran_barang'];
                            $idbarangnya = $fetcharray['id_barang'];
                        ?>

                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya ?>&nbsp;<?= $merkbarang ?>&nbsp;<?= $ukuranbarang ?></option>

                        <?php
                        }
                        ?>

                    </select>
                    <br>
                    <input type="number" name="jumlahkeluar" placeholder="Jumlah Obat" class="form-control" required>
                    <br>
                    <input type="text" name="keterangan" placeholder="Keterangan Penerima" class="form-control" required>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Export -->
<div class="modal fade" id="exportModalkeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Periode Waktu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="exportkeluar.php" method="post">
                <div class="modal-body">
                    <h7> Waktu Awal </h7>
                    <input type="date" id="from" name="tanggalawalkeluar" onchange="compareDates();" placeholder="" class="form-control" required>
                    <br>
                    <h7> Waktu Akhir </h7>
                    <input type="date" id="to" name="tanggalakhirkeluar" onchange="compareDates();" placeholder="" class="form-control" required>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btnExport" type="submit" name="exportkeluar" disabled>Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>


</html>