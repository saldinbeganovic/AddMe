<?php
session_start();
date_default_timezone_set("Europe/Ljubljana");
$_SESSION['limit_s']=4;


// 2 hours in seconds
//$inactive = 7200;

//ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours


//if (isset($_SESSION['user_id']) && (time() - $_SESSION['user_id'] > $inactive)) {
    // last request was more than 2 hours ago
    //include 'database.php';
    //$query = "UPDATE uporabniki SET active=0 WHERE id=?";
    //$stmt = $pdo->prepare($query);
    //$stmt->execute([$_SESSION['user_id']]);
    //session_unset();     // unset $_SESSION variable for this page
    //session_destroy();   // destroy session data
//}

/*
if(isset($_SESSION["user_id"]))
      {
           if((time() - $_SESSION['last_login_timestamp']) > 7200) // 900 = 15 * 60
           {
                header("location:functions/logout.php");
           }

      }
      else
      {
           header('location:functions/login.php');
      }
*/



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
