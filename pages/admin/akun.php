<?php
require_once '../../controller/connection.php';
require_once '../../controller/auth-admin.php';
require_once '../../controller/manage-akun.php'
?>

<?php 


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
    <title>Profil</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                    <span>Daftar Akun</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <div class="sidebar-heading">
                Akun
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="akun.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="<?=BASEURL?>/controller/process-logout.php">
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

                <!-- Topbar -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mt-4 mb-0 text-gray-800">Profil Admin</h1>


                    </div>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
   
                    <div class="container-fluid">



                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                            </div>
                            <div class="card-body">
                                <?php

                                $ambilsemuadatastock = mysqli_query($conn, "select * from users where role = 'admin' ");
                                $i = 1;
                                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {

                                    $username = $data['username'];
                                    $password = $data['password'];
                                    $id_user = $data['id_user'];
                            
                                ?>
                                <form method="post">
                                    <div class="form-group row">
                                        <label for="inputUsername" class="col-sm-2 col-form-label">Username Admin</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="username" value="<?= $username; ?>" placeholder="Username  Admin" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password Admin</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="password" value="<?= $password; ?>" placeholder="Password Admin" class="form-control" required>
                                        </div>
                                    </div>



                                    <input type="hidden" name="id_user" value="<?= $id_user ?>">

                                    <br>
                                    <button type="submit" class="btn btn-primary float-right" name="updateadmin">Submit</button>

                                </form>
                                <?php
                                }
                                ?>
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
        } );
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="post">
      <div class="modal-body">
      <input type="text" name="nama_puskesmas" placeholder="Nama Puskesmas" class="form-control" required>
      <br>
      <input type="text" name="alamat_puskesmas" placeholder="Alamat Puskesmas" class="form-control" required>
      <br>
      <input type="text" name="lokasi_puskesmas" placeholder="Kecamatan" class="form-control" required>
      <br>
      <input type="text" name="penanggungjawab" placeholder="Penanggungjawab" class="form-control" required>
      <br>
      <input type="text" name="username_puskesmas" placeholder="Username" class="form-control" required>
      <br>
      <input type="text" name="password_puskesmas" placeholder="Password" class="form-control" required>
        </div>
      

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addnewuser">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

</html>