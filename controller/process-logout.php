<?php
require_once('./connection.php');
error_reporting(E_ERROR);
session_start();
session_destroy();
redirect('/')
?>