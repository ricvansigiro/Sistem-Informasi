<?php
require '../../controller/connection.php';
require '../../controller/auth-user.php';
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

            <li class="nav-item active">
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

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 mt-3 ml-4 mr-4 static-top shadow justify-content-between">
                    <h3 class="m-0 font-weight-bold text-primary">Welcome Back, Puskesmas <?= $username ?></h3>
                    <h6 class="m-0 font-weight-bold text-primary"><?= date("F j, Y g:i a") ?></h6>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <div class="row">

                        <!-- Chart 1-->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Barang Masuk Bulan ini</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="chart"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                        

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Barang Kadaluarsa</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="piechart1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Chart 1-->
                        <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Barang Keluar Bulan ini</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="chart2"></canvas>
                                </div>

                            </div>
                        </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Barang Non Kadaluarsa</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="piechart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <?php
                    $ambilsemuadatamasuk = mysqli_query($conn, "select c.nama_barang, c.merk_barang, c.ukuran_barang, sum(d.jumlah) as totalmasuk from users a
                    INNER join users_stock b
                    on a.id_user = b.id_user

                    INNER join stock_barang c
                    on b.id_barang = c.id_barang

                    right join masuk d
                    on c.id_barang = d.id_barang

                    where a.username = '$username' AND
                    YEAR(d.tanggal) = YEAR(CURRENT_DATE()) AND 
                    MONTH(d.tanggal) = MONTH(CURRENT_DATE())
                    GROUP BY c.id_barang
                    ");

                    $ambilsemuadatakeluar = mysqli_query($conn, "select c.nama_barang, c.merk_barang, c.ukuran_barang, sum(d.jumlah) as totalkeluar from users a
                    INNER join users_stock b
                    on a.id_user = b.id_user

                    INNER join stock_barang c
                    on b.id_barang = c.id_barang

                    right join keluar d
                    on c.id_barang = d.id_barang

                    where a.username = '$username'AND
                    YEAR(d.tanggal) = YEAR(CURRENT_DATE()) AND 
                    MONTH(d.tanggal) = MONTH(CURRENT_DATE())
                    GROUP BY c.id_barang
                    ");

                    $ambilsemuadatakadaluarsa = mysqli_query($conn, "select c.nama_barang, c.merk_barang, c.ukuran_barang, sum(d.jumlah) as totalkadaluarsa from users a
                    INNER join users_stock b
                    on a.id_user = b.id_user

                    INNER join stock_barang c
                    on b.id_barang = c.id_barang

                    right join masuk d
                    on c.id_barang = d.id_barang

                    where a.username = '$username'AND
                    YEAR(d.tanggal) = YEAR(CURRENT_DATE()) AND 
                    MONTH(d.tanggal) = MONTH(CURRENT_DATE())
                    and is_expired = 1
                    GROUP BY c.id_barang
                    ");

                    $ambilsemuadatanonkadaluarsa = mysqli_query($conn, "select c.nama_barang, c.merk_barang, c.ukuran_barang, sum(d.jumlah) as totalnonkadaluarsa from users a
                    INNER join users_stock b
                    on a.id_user = b.id_user

                    INNER join stock_barang c
                    on b.id_barang = c.id_barang

                    right join masuk d
                    on c.id_barang = d.id_barang

                    where a.username = '$username'AND
                    YEAR(d.tanggal) = YEAR(CURRENT_DATE()) AND 
                    MONTH(d.tanggal) = MONTH(CURRENT_DATE())
                    and is_expired = 0
                    GROUP BY c.id_barang
                    ");



                    $data_masuk = mysqli_fetch_all($ambilsemuadatamasuk, MYSQLI_ASSOC);
                    foreach ($data_masuk as $values) {
                        $labelmasuk[] = $values['nama_barang'];
                        $merkmasuk[] = $values['merk_barang'];
                        $ukuranmasuk[] = $values['ukuran_barang'];
                        $masuk[] = $values['totalmasuk'];
                    }

                    $data_keluar = mysqli_fetch_all($ambilsemuadatakeluar, MYSQLI_ASSOC);
                    foreach ($data_keluar as $values) {
                        $labelkeluar[] = $values['nama_barang'];
                        $merkkeluar[] = $values['merk_barang'];
                        $ukurankeluar[] = $values['ukuran_barang'];
                        $keluar[] = $values['totalkeluar'];
                    }
                    $data_kadaluarsa = mysqli_fetch_all($ambilsemuadatakadaluarsa, MYSQLI_ASSOC);
                    foreach ($data_kadaluarsa as $values) {
                        $labelkadaluarsa[] = $values['nama_barang'];
                        $merkkadaluarsa[] = $values['merk_barang'];
                        $ukurankadaluarsa[] = $values['ukuran_barang'];
                        $kadaluarsa[] = $values['totalkadaluarsa'];
                    }
                    $data_nonkadaluarsa = mysqli_fetch_all($ambilsemuadatanonkadaluarsa, MYSQLI_ASSOC);
                    foreach ($data_nonkadaluarsa as $values) {
                        $labelnonkadaluarsa[] = $values['nama_barang'];
                        $merknonkadaluarsa[] = $values['merk_barang'];
                        $ukurannonkadaluarsa[] = $values['ukuran_barang'];
                        $nonkadaluarsa[] = $values['totalnonkadaluarsa'];
                    }
                    ?>
                    





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
            <!--chart 1-->
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script>
                var ctx = document.getElementById("chart");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labelmasuk)?>,
                        datasets: [{
                            label: "Jumlah Barang Masuk",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: <?php echo json_encode($masuk) ?>,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,

                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ':' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                })
            </script>
            <!--chart 2-->
            <script>
                var ctx = document.getElementById("chart2");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labelkeluar) ?>,
                        datasets: [{
                            label: "Jumlah Barang Keluar",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: <?php echo json_encode($keluar) ?>,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,

                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                })
            </script>
            <script>
                // Pie Chart 1
                var ctx = document.getElementById("piechart1");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode($labelkadaluarsa) ?>,
                        datasets: [{
                            data: <?php echo json_encode($kadaluarsa) ?>,
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            </script>

            <script>
                // Pie Chart 2
                var ctx = document.getElementById("piechart2");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode($labelnonkadaluarsa) ?>,
                        datasets: [{
                            data: <?php echo json_encode($nonkadaluarsa) ?>,
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            </script>

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
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsibarang" placeholder="Deskripsi Barang" class="form-control" required>
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