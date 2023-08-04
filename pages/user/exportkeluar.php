<?php
require_once '../../controller/connection.php';
require_once '../../controller/auth-user.php';
require_once '../../controller/barang-keluar.php';
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition:attachment;  filename=laporan-obat-keluar.xls");
?>
<html>
<head>
  <title>Data Obat Keluar</title>
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
        <p align="center">Laporan Data Obat Keluar <?php 

                if (isset($_POST['exportkeluar'])) {
                    $tanggalawalkeluar = $_POST['tanggalawalkeluar'];
                    $tanggalakhirkeluar = $_POST['tanggalakhirkeluar'];

        echo tanggal_indonesia($tanggalawalkeluar) ?> - <?= tanggal_indonesia($tanggalakhirkeluar) ?> </p>
				<div>
					
                <table border="1" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Keluar</th>
                                            
                                            
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
                                        
                                        where a.id_user = '$id_user' and
                                        c.tanggal between '$tanggalawalkeluar'and'$tanggalakhirkeluar'");
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
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
                                        <td><?= $namabarang?>&nbsp;<?= $merkbarang?>&nbsp;<?=$ukuranbarang?>&nbsp;<?=$deskripsi?></td>
                                        <td><?= $jumlah ?>&nbsp;<?=$satuan?></td>
                                        <td><?= $keterangan ?></td>
                                        <td><?= $tanggal ?></td>
                                        </tr>




                                        <?php
                                        }
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