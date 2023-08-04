<?php
require_once 'connection.php';


if (isset($_POST['addnewuser'])){
    addUser($conn);
}
if (isset($_POST['updateuser'])){
    updateUser($conn);
}
if (isset($_POST['hapususer'])){
    deleteUser($conn);
}

function addUser($conn)
{
    if (isset($_POST['addnewuser'])) {
        $nama_puskesmas = $_POST['nama_puskesmas'];
        $alamat_puskesmas = $_POST['alamat_puskesmas'];
        $lokasi_puskesmas = $_POST['lokasi_puskesmas'];
        $penanggungjawab = $_POST['penanggungjawab'];
        $username_puskesmas = $_POST['username_puskesmas'];
        $password_puskesmas = $_POST['password_puskesmas'];

        $addtotable = mysqli_query($conn, "insert into users(username, password, nama_puskesmas, alamat_puskesmas, lokasi_puskesmas, penanggungjawab, role) values ('$username_puskesmas','$password_puskesmas', '$nama_puskesmas', '$alamat_puskesmas','$lokasi_puskesmas','$penanggungjawab','user')");

        if ($addtotable) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data Gagal diInput.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
}

function updateUser($conn)
{
    if (isset($_POST['updateuser'])) {
        $id_user = $_POST['id_user'];
        $nama_puskesmas = $_POST['nama_puskesmas'];
        $alamat_puskesmas = $_POST['alamat_puskesmas'];
        $lokasi_puskesmas = $_POST['lokasi_puskesmas'];
        $penanggungjawab = $_POST['penanggungjawab'];
        $username_puskesmas = $_POST['username_puskesmas'];
        $password_puskesmas = $_POST['password_puskesmas'];

        $update = mysqli_query($conn, "update users set nama_puskesmas='$nama_puskesmas',alamat_puskesmas='$alamat_puskesmas',lokasi_puskesmas = '$lokasi_puskesmas', penanggungjawab = '$penanggungjawab',username='$username_puskesmas', password='$password_puskesmas' where id_user ='$id_user'");
        if ($update) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data Gagal diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
}

function deleteUser($conn)
{
    if (isset($_POST['hapususer'])) {
        $id_user = $_POST['id_user'];

        $hapus = mysqli_query($conn, "delete from users where id_user ='$id_user'");
        $hapusKeluar = mysqli_query($conn, "delete from users_keluar where id_user ='$id_user'");
        $hapusMasuk = mysqli_query($conn, "delete from users_masuk where id_user ='$id_user'");
        $hapusStock = mysqli_query($conn, "delete from users_stock id_user ='$id_user'");

        if ($hapus ) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diHapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data gagal dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
}
