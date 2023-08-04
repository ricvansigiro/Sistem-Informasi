<?php

require_once 'connection.php';

if(!isset($_SESSION['log'])){
    redirect('/pages/shared/login.php');
} else{
    if(isset($_SESSION['isUser'])){
        $_SESSION['err_isUser'] = true;
        redirect('/pages/shared/error.php');
    } else{
        
    }
}
