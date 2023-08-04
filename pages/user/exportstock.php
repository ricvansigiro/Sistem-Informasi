<?php
require '../../controller/connection.php';
require '../../controller/auth-user.php';
require '../../controller/barang-jenis.php';
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition:attachment;  filename=laporan-stok-barang.xls");
?>
<html>

<head>
    <title>Data Stock Obat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
    <?php
        $alamatpuskes = mysqli_query($conn, "select alamat_puskesmas as alamat from users where username = '$username' ");
        $alamat = mysqli_fetch_array($alamatpuskes);
        ?>
        <P align="center" style="font-size:18pt">Puskesmas <?php echo $username; ?><br><?php echo $alamat['alamat'] ?></p>
        <p align="center">Laporan Data Stok Obat Per &nbsp;<?php echo tanggal_indonesia(date('Y-m-d') ) ?>, <?php echo date('H:i:s')?> </p>

        <div>

            <table border="1" id="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Ukuran Dosis</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Stok Expired</th>

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
                        </tr>



                    <?php
                    };
                    ?>
                </tbody>


            </table>

        </div>
    </div>

<br>
    <?php
    $lokasi = mysqli_query($conn, "select lokasi_puskesmas as lokasi from users where id_user = '$id_user' ");
    $lokasi_puskesmas = mysqli_fetch_assoc($lokasi);
    $penanggungjawab = mysqli_query($conn, "select penanggungjawab as pj from users where id_user = '$id_user' ");
    $penanggungjawab_puskesmas = mysqli_fetch_array($penanggungjawab);

    ?>
    <div style="width:600px;float:right">
        <p align="right" class="text-center"><?php echo $lokasi_puskesmas['lokasi'] ?>, <?php echo tanggal_indonesia(date('Y-m-d')) ?></p>
        <p align="right" class="text-center"> Penanggung Jawab </p>
        <br>
        <br>
        <p align="right" class="text-center"> <?php echo $penanggungjawab_puskesmas['pj'] ?> </p>
    </div>

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