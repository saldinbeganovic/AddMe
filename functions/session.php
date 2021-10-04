<?php
session_start();
date_default_timezone_set("Europe/Ljubljana");
$_SESSION['limit_s']=4;





  


/*
if(!isset($_SESSION['user_id'])
        && $_SERVER['REQUEST_URI']!='/etrznica/login.php'
        && $_SERVER['REQUEST_URI']!='/etrznica/registration.php'
        && $_SERVER['REQUEST_URI']!='/etrznica/login_check.php') {
    header("Location: login.php");
    die();
}
/*
function isAdmin() {
    $result = false;
    if (isset($_SESSION['admin']) && ($_SESSION['admin']==1)) {
        $result = true;
    }
    return $result;
}

function adminOnly() {
    //če ni admin, ga preusmeri na index
    if (!isAdmin()) {
        header("Location: index.php");
        die();
    }
}

*/

?>
