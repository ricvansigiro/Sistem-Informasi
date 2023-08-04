<?php
require '../../controller/connection.php';
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php if(isset($_SESSION['err_isAdmin'])){ ?>
<div class="text-center">
    <div class="error mx-auto" data-text="404">403</div>
    <p class="lead text-gray-800 mb-5">Access Foribidden</p>
    <p class="text-gray-500 mb-0">Kamu tidak boleh mengakses Halaman User</p>
    <a href="<?=BASEURL?>">← Back to Dashboard</a>
</div>
<?php unset($_SESSION['err_isAdmin']); } ?>

<?php if(isset($_SESSION['err_isUser'])){ ?>
<div class="text-center">
    <div class="error mx-auto" data-text="404">403</div>
    <p class="lead text-gray-800 mb-5">Access Foribidden</p>
    <p class="text-gray-500 mb-0">Kamu tidak boleh mengakses Halaman Admin</p>
    <a href="<?=BASEURL?>">← Back to Dashboard</a>
</div>
<?php unset($_SESSION['err_isUser']); } ?>


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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>


</body>
</html>

