<?php
require '../../controller/connection.php';
if(isset($_SESSION['isAdmin'])){
    redirect('/pages/admin');
}elseif(isset($_SESSION['isUser'])){
    redirect('/pages/user');
}
?>
  
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?=BASEURL?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=BASEURL?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-one">
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">
        
        

        <!-- Outer Row -->
        <div class="row d-flex justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9 my-auto">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-log-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Invomas</h1>
                                    </div>
                                    <form method="post" class="user" action="<?=BASEURL?>/controller/process-login.php">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="Username" 
                                                placeholder="Enter Username..." name="username" >

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="Password" placeholder="Password" name="password" >
                                        </div>
                                        <div class="form-group">
                                            <?php  
                                                if(isset($_SESSION['login_err'])){
                                            ?>
                                                <p class="text-danger"><?= $_SESSION['login_err'] ?></p>
                                            <?php unset($_SESSION['login_err']); } ?>
                                        <button  class="btn btn-primary btn-user btn-block" name="login">
                                            Login
                                        </button>
                                        
                                        </div>
                                        <div>
                                            
                                        </div>

                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

</body>

</html>