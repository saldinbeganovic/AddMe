<?php
session_start();
include '../functions/function.php';

if(isAdmin($_SESSION['user_id']))
{
    header("Location: dashboard/index.php");
}else {
    header("Location: ../index.php");
}

 ?>
