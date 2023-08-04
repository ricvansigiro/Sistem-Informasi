<?php
include_once 'connection.php';

if (isset($_POST['addnewbarang'])) {
  addNewBarang($conn, $id_user);
}
if (isset($_POST['updatebarang'])) {
  updateBarang($conn);
}
if (isset($_POST['hapusbarang'])) {
  deleteBarang($conn);
}

function addNewBarang($conn, $id_user)
{
  if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $merkbarang = $_POST['merkbarang'];
    $ukuranbarang = $_POST['ukuranbarang'];
    $deskripsibarang = $_POST['deskripsibarang'];
    $satuanbarang = $_POST['satuanbarang'];


    $addtotable = mysqli_query($conn, "insert into stock_barang(nama_barang, deskripsi_barang, merk_barang, ukuran_barang, satuan_barang) values ('$namabarang','$deskripsibarang','$merkbarang','$ukuranbarang','$satuanbarang')");

    $idbaru = mysqli_query($conn, "SELECT id_barang FROM stock_barang ORDER BY id_barang DESC LIMIT 1");
    $idbaru_array = mysqli_fetch_array($idbaru);
    $idbaru = $idbaru_array[0];

    $addBaru = mysqli_query($conn, "insert into users_stock(id_user, id_barang) values ('$id_user', '$idbaru')");

    if ($addtotable && $addBaru) {
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diinput.
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

function updateBarang($conn)
{
  if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsibarang'];
    $merkbarang = $_POST['merkbarang'];
    $ukuranbarang = $_POST['ukuranbarang'];
    $satuanbarang = $_POST['satuanbarang'];

    $update = mysqli_query($conn, "update stock_barang set nama_barang='$namabarang',deskripsi_barang='$deskripsi',merk_barang = '$merkbarang', ukuran_barang = '$ukuranbarang',satuan_barang = '$satuanbarang' where id_barang ='$idb'");
    if ($update) {
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    } else {
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data berhasil diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
  }
}


function deleteBarang($conn)
{

  if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock_barang where id_barang ='$idb'");
    $hapusMasuk = mysqli_query($conn, "delete from masuk where id_barang ='$idb'");
    $hapusKeluar = mysqli_query($conn, "delete from keluar where id_barang ='$idb'");
    $hapusRelasi = mysqli_query($conn, "delete from users_stock where id_barang ='$idb'");

    if ($hapus && $hapusRelasi && $hapusMasuk && $hapusKeluar) {
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
