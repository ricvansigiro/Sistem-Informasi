<?php
require_once 'connection.php';

if (isset($_POST['barangkeluar'])) {
    addBarangKeluar($conn, $id_user);
}
if (isset($_POST['updatebarangkeluar'])) {
    updateBarangKeluar($conn);
}
if (isset($_POST['hapusbarangkeluar'])) {
    deleteBarangKeluar($conn);
}



function addBarangKeluar($conn, $id_user)
{
    if (isset($_POST['barangkeluar'])) {
        $barangnya = $_POST['barangnya'];
        $jumlahkeluar = $_POST['jumlahkeluar'];
        $keterangan = $_POST['keterangan'];

        $username = $_SESSION['username'];
        $ambilsemuadatastock = mysqli_query($conn, "select * from users a
                INNER join users_stock b
                on a.id_user = b.id_user
        
                INNER join stock_barang c
                on b.id_barang = c.id_barang
                where a.username = '$username'
                and b.id_barang = '$barangnya'
                ");

        error_reporting(E_ERROR);

        $data = mysqli_fetch_array($ambilsemuadatastock);

        $idb = $data['id_barang'];
        $hitungbarang = mysqli_query($conn, "select id_barang, sum(jumlah) as stok from masuk 
                where id_barang = '$idb' and is_expired = 0");
        $fetchbarang = mysqli_fetch_assoc($hitungbarang);

        $hitungbarangkeluar = mysqli_query($conn, "select id_barang, sum(jumlah) as stokkeluar from keluar 
                where id_barang = '$idb'
                GROUP BY id_barang");
        $fetchkeluar = mysqli_fetch_assoc($hitungbarangkeluar);

        $stocksekarang = $fetchbarang['stok'] - $fetchkeluar['stokkeluar'];

        if($jumlahkeluar<$stocksekarang){

        $addtokeluar = mysqli_query($conn, "insert into keluar(id_barang, jumlah, deskripsi) values ('$barangnya','$jumlahkeluar','$keterangan')");
        $idbaru_keluar = mysqli_query($conn, "SELECT id_keluar FROM keluar ORDER BY id_keluar DESC LIMIT 1");
        $idbaru_keluar_array = mysqli_fetch_array($idbaru_keluar);
        $idbaru_keluar = $idbaru_keluar_array[0];

        $addtokeluaruser = mysqli_query($conn, "insert into users_keluar(id_user, id_keluar) values ('$id_user','$idbaru_keluar')");

        if ($addtokeluar && $addtokeluaruser) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        } else {
            echo ' <div class="alert alert-Danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data gagal diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        }
    }else{
        echo '
        <script>alert("Stock Tidak Mencukupi");
        window.location.href="keluar.php";
        </script>
        ';
    }
    }
}

function updateBarangKeluar($conn)
{
    if (isset($_POST['updatebarangkeluar'])) {
        $idb = $_POST['idb'];
        $idk = $_POST['idk'];
        $jumlah = $_POST['jumlah'];
        $keterangan = $_POST['keterangan'];

        $jumlahsekarang = mysqli_query($conn, "select * from keluar where id_keluar = '$idk'");
        $jumlahnya = mysqli_fetch_array($jumlahsekarang);
        $jumlahsekarang = $jumlahnya['jumlah'];

        $username = $_SESSION['username'];
        $ambilsemuadatastock = mysqli_query($conn, "select * from users a
                INNER join users_stock b
                on a.id_user = b.id_user
        
                INNER join stock_barang c
                on b.id_barang = c.id_barang
                where a.username = '$username'
                and b.id_barang = '$idb'
                ");

        error_reporting(E_ERROR);

        $data = mysqli_fetch_array($ambilsemuadatastock);

        $idb = $data['id_barang'];
        $hitungbarang = mysqli_query($conn, "select id_barang, sum(jumlah) as stok from masuk 
                where id_barang = '$idb' and is_expired = 0");
        $fetchbarang = mysqli_fetch_assoc($hitungbarang);

        $hitungbarangkeluar = mysqli_query($conn, "select id_barang, sum(jumlah) as stokkeluar from keluar 
                where id_barang = '$idb'
                GROUP BY id_barang");
        $fetchkeluar = mysqli_fetch_assoc($hitungbarangkeluar);

        $stocksekarang = $fetchbarang['stok'] - $fetchkeluar['stokkeluar'];




        $selisih = $jumlah - $jumlahsekarang;
        if ($selisih <= $stocksekarang) {

            $updatekeluar = mysqli_query($conn, "update keluar set jumlah='$jumlah', deskripsi='$keterangan' where id_keluar = '$idk'");
            if ($updatekeluar) {
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Data berhasil diEdit.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';

            } else {
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data Gagal diEdit.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        } else {
            echo '
                <script>alert("Stock tidak mencukupi");
                window.location.href="keluar.php";
                </script>
                ';
        }
    }
}

// function updateBarangKeluar($conn)
// {

//     if (isset($_POST['updatebarangkeluar'])) {
//         $idk = $_POST['idk'];
//         $jumlah = $_POST['jumlah'];
//         $keterangan = $_POST['keterangan'];

//         $username = $_SESSION['username'];
//         $ambilsemuadatastock = mysqli_query($conn, "select * from users a
//         INNER join users_stock b
//         on a.id_user = b.id_user

//         INNER join stock_barang c
//         on b.id_barang = c.id_barang
//         where a.username = '$username'
//         ");

//         error_reporting(E_ERROR);

//         $data = mysqli_fetch_array($ambilsemuadatastock);

//         $idb = $data['id_barang'];
//         $hitungbarang = mysqli_query($conn, "select id_barang, sum(jumlah) as stok from masuk 
//         where id_barang = '$idb' and is_expired = 0");
//         $fetchbarang = mysqli_fetch_assoc($hitungbarang);

//         $hitungbarangkeluar = mysqli_query($conn, "select id_barang, sum(jumlah) as stokkeluar from keluar 
//         where id_barang = '$idb'
//         GROUP BY id_barang");
//         $fetchkeluar = mysqli_fetch_assoc($hitungbarangkeluar);



//         $jumlahsekarang = mysqli_query($conn, "select * from keluar where id_keluar = '$idk'");
//         $jumlahnya = mysqli_fetch_array($jumlahsekarang);
//         $jumlahsekarang = $jumlahnya['jumlah'];
//         $update = mysqli_query($conn, "update keluar set jumlah='$jumlah', deskripsi= '$keterangan' where id_keluar ='$idk'");

//         if ($jumlah > $jumlahsekarang) {
//             $selisih = $jumlah - $jumlahsekarang;
//             if ($selisih <= $jumlahsekarang) {
//                 $update;
//                 if ($update) {
//                     header('location:keluar.php');
//                 } else {
//                     echo 'gagal1';
//                     header('location:keluar.php');
//                 }
//             } else {
//                 echo '
//                 <script>alert("Stock tidak mencukupi");
//                 window.location.href="keluar.php";
//                 </script>
//                 ';
//             }
//         } else {
//             $update;
//             if ($update) {
//                 header('location:keluar.php');
//             } else {
//                 echo 'gagal3';
//                 header('location:keluar.php');
//             }
//         }
//     }
// }


function deleteBarangKeluar($conn)
{
    if (isset($_POST['hapusbarangkeluar'])) {
        
        $idk = $_POST['idk'];


        $hapusdata = mysqli_query($conn, "delete from keluar where id_keluar='$idk'");

        $hapuskeluarRelasi = mysqli_query($conn, "delete from users_keluar where id_keluar ='$idk'");


        if ($hapusdata && $hapuskeluarRelasi) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diHapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        } else {
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data berhasil diHapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        }
    }
}
