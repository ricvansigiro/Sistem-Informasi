<?php
require '../../controller/connection.php';
require '../../controller/auth-admin.php';
require_once '../../controller/manage-user.php'
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
    <title>Dashboard</title>

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
                <div class="sidebar-brand-text mx-3">Invomas      </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <br>
            <div class="sidebar-heading">
                Dashboard
            </div>
            
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Daftar Akun</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <div class="sidebar-heading">
                Akun
            </div>

            <li class="nav-item">
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 mt-3 ml-4 mr-4 static-top shadow justify-content-between">                
                <h3 class="m-0 font-weight-bold text-primary">Hellow,  <?=$username?> !!</h3>
                <h6 class="m-0 font-weight-bold text-primary"><?=date("F j, Y g:i a")?></h6>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tabel Akun</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah User</button>     
                    
                    </div>
                    
                    <div class="container-fluid">
                    
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Akun</h6>
                        </div>
                        
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Puskesmas</th>
                                            <th>Alamat Puskesmas</th>
                                            <th>Kecamatan</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from users");
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            
                                            $nama_puskesmas = $data['nama_puskesmas'];
                                            $alamat_puskesmas = $data['alamat_puskesmas'];
                                            $lokasi_puskesmas = $data['lokasi_puskesmas'];
                                            $penanggungjawab = $data['penanggungjawab'];
                                            $username_puskesmas = $data['username'];
                                            $password_puskesmas = $data['password'];
                                            $id_user = $data['id_user'];
                                        ?>

                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$nama_puskesmas?></td>
                                            <td><?=$alamat_puskesmas?></td>
                                            <td><?=$lokasi_puskesmas?></td>
                                            <td><?=$penanggungjawab?></td>
                                            <td><?=$username_puskesmas?></td>
                                            <td><?=$password_puskesmas?></td>
                                            <td>

                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id_user;?>">Edit</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?=$id_user;?>">Hapus</button>
  
                                            </td>
                                        </tr>
                                        <!--modal edit-->
                                        <div class="modal fade" id="edit<?=$id_user;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Puskesmas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form method="post">
                                            <div class="modal-body">
                                            <h7>Nama Puskesmas</h7>
                                            <input type="text" name="nama_puskesmas" value="<?=$nama_puskesmas;?>"placeholder="Nama Puskesmas" class="form-control" required>
                                            <br>
                                            <h7>Alamat Puskesmas</h7>
                                            <input type="text" name="alamat_puskesmas" value="<?=$alamat_puskesmas;?>" placeholder="Alamat Puskesmas" class="form-control" required>
                                            <br>
                                            <h7>Kecamatan</h7>
                                            <input type="text" name="lokasi_puskesmas" value="<?=$lokasi_puskesmas;?>" placeholder="Kecamatan" class="form-control" required>
                                            <br>
                                            <h7>Penanggung Jawab</h7>
                                            <input type="text" name="penanggungjawab" value="<?=$penanggungjawab;?>" placeholder="Penanggungjawab" class="form-control" required>
                                            <br>
                                            <h7>Username</h7>
                                            <input type="text" name="username_puskesmas" value="<?=$username_puskesmas;?>" placeholder="Username" class="form-control" required>
                                            <br>
                                            <h7>Password</h7>
                                            <input type="text" name="password_puskesmas" value="<?=$password_puskesmas;?>" placeholder="Password" class="form-control" required>
                                            <br>
                                            <input type="hidden" name="id_user" value="<?=$id_user?>">

                                        
                                            </div>
                                            

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="updateuser">Submit</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>



                                        <!--modal delete-->
                                        <div class="modal fade" id="hapus<?=$id_user;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Puskesmas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah Anda Yakin Ingin Menghapus Data <?=$nama_puskesmas;?>?
                                            <br>
                                            <input type="hidden" name="id_user" value="<?=$id_user?>">
                                
                                            </div>
                                            

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="hapususer">Hapus</button>
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