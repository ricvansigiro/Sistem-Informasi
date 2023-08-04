<?php

if (isset($_POST['updateprofil'])){
    updateProfil($conn);
}
if (isset($_POST['updateadmin'])){
  updateAdmin($conn);
}
function updateProfil($conn)
{
    if (isset($_POST['updateprofil'])) {
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
            echo 'gagal';
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data Gagal diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
}

function updateAdmin($conn)
{
    if (isset($_POST['updateadmin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id_user = $_POST['id_user'];

        $update = mysqli_query($conn, "update users set username='$username',password='$password' where id_user ='$id_user'");
        if ($update) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> Data berhasil diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            echo 'gagal';
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data Gagal diEdit.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
}