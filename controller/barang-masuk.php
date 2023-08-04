<?php
require_once 'connection.php';

// checkKadaluarsa($conn);

if (isset($_POST['barangmasuk'])) {
  addBarangMasuk($conn, $id_user);
}
if (isset($_POST['updatebarangmasuk'])) {
  updateBarangMasuk($conn);
}
if (isset($_POST['hapusbarangmasuk'])) {
  deleteBarangMasuk($conn);
}



function checkKadaluarsa($conn)
{
  $query  = "select * from masuk";
  $result = $conn->query($query);

  while ($data = $result->fetch_assoc()) {
    $idm = $data['id_masuk'];
    $tanggalexpired = $data['tanggal_expired'];
    $tanggalsekarang = date('Y-m-d');
    $isexpired = $data['is_expired'];

    if ($tanggalexpired <= $tanggalsekarang) {
      $isexpired = true;
    } else {
      $isexpired = false;
    }
    $queryInsert = "update masuk
        set is_expired = '$isexpired' where '$idm' = id_masuk";
    $insert = mysqli_query($conn, $queryInsert);
    if ($insert) {
    } else {
    }
  }
}

function addBarangMasuk($conn, $id_user)
{
  if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $jumlahmasuk = $_POST['jumlahmasuk'];
    $tanggalexpired = $_POST['tanggalexpired'];
    $tanggalsekarang = date('Y-m-d');

    if ($tanggalexpired <= $tanggalsekarang) {
      $addtomasuk = mysqli_query($conn, "insert into masuk(id_barang, jumlah,tanggal_expired,is_expired) values ('$barangnya','$jumlahmasuk','$tanggalexpired','1')");
      $idbaru_masuk = mysqli_query($conn, "SELECT id_masuk FROM masuk ORDER BY id_masuk DESC LIMIT 1");
      $idbaru_masuk_array = mysqli_fetch_array($idbaru_masuk);
      $idbaru_masuk = $idbaru_masuk_array[0];

      $addtomasukuser = mysqli_query($conn, "insert into users_masuk(id_user, id_masuk) values ('$id_user','$idbaru_masuk')");

      if ($addtomasuk && $addtomasukuser) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
      } else {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data gagal diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
      }
    }else{
      $addtomasuk = mysqli_query($conn, "insert into masuk(id_barang, jumlah,tanggal_expired,is_expired) values ('$barangnya','$jumlahmasuk','$tanggalexpired','0')");
      $idbaru_masuk = mysqli_query($conn, "SELECT id_masuk FROM masuk ORDER BY id_masuk DESC LIMIT 1");
      $idbaru_masuk_array = mysqli_fetch_array($idbaru_masuk);
      $idbaru_masuk = $idbaru_masuk_array[0];

      $addtomasukuser = mysqli_query($conn, "insert into users_masuk(id_user, id_masuk) values ('$id_user','$idbaru_masuk')");

      if ($addtomasuk && $addtomasukuser) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
      } else {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data gagal diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
      }
    }
  }
}

// function updateBarangMasuk($conn)
// {
//     if (isset($_POST['updatebarangmasuk'])) {
//         $idb = $_POST['idb'];
//         $idm = $_POST['idm'];
//         $jumlah = $_POST['jumlah'];

//         $lihatstock = mysqli_query($conn, "select * from stock_barang where id_barang='$idb'");
//         $stocknya = mysqli_fetch_array($lihatstock);
//         $stocksekarang = $stocknya['stock_barang'];

//         $jumlahsekarang = mysqli_query($conn, "select * from masuk where id_masuk = '$idm'");
//         $jumlahnya = mysqli_fetch_array($jumlahsekarang);
//         $jumlahsekarang = $jumlahnya['jumlah'];

//         if ($jumlah > $jumlahsekarang) {
//             $selisih = $jumlah - $jumlahsekarang;
//             $countkurang = $stocksekarang + $selisih;
//             $kurangkanstock = mysqli_query($conn, "update stock_barang set stock_barang='$countkurang' where id_barang = '$idb'");
//             $updatemasuk = mysqli_query($conn, "update masuk set jumlah='$jumlah' where id_masuk = '$idm'");
//             if ($updatemasuk && $kurangkanstock) {
//                 // header('location:masuk.php');
//             } else {
//                 echo 'gagal';
//                 // header('location:keluar.php');
//             }
//         } else {
//             $selisih = $jumlahsekarang - $jumlah;
//             $countkurang = $stocksekarang - $selisih;
//             $kurangkanstock = mysqli_query($conn, "update stock_barang set stock_barang='$countkurang'where id_barang='$idb'");
//             $updatemasuk = mysqli_query($conn, "update masuk set jumlah='$jumlah' where id_masuk = '$idm'");
//             if ($updatemasuk && $kurangkanstock) {
//                 // header('location:masuk.php');
//             } else {
//                 echo 'gagal';
//                 // header('location:masuk.php');
//             }
//         }
//     }
// }
function updateBarangMasuk($conn)
{
  if (isset($_POST['updatebarangmasuk'])) {
    $idm = $_POST['idm'];
    $jumlah = $_POST['jumlah'];
    $tanggalexpired = $_POST['tanggal_expired'];

    $update = mysqli_query($conn, "update masuk set jumlah='$jumlah', tanggal_expired='$tanggalexpired' where id_masuk ='$idm'");
    if ($update) {
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    } else {
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data gagal diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
  }
}

function deleteBarangMasuk($conn)
{
  if (isset($_POST['hapusbarangmasuk'])) {
    $idm = $_POST['idm'];


    $hapusdata = mysqli_query($conn, "delete from masuk where id_masuk='$idm'");

    $hapusmasukRelasi = mysqli_query($conn, "delete from users_masuk where id_masuk ='$idm'");



    if ($hapusdata && $hapusmasukRelasi) {
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diHapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    } else {
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data gagal diHapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
  }
}
