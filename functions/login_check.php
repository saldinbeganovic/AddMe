<?php
include_once 'session.php';
require 'database.php';
$usern = $_POST['uname'];
$pass = $_POST['pass'];


if (!empty($usern) && !empty($pass)) {
 //$pass = sha1($pass.$salt);
 $query = "SELECT * FROM uporabniki WHERE username=?";
 $stmt = $pdo->prepare($query);
 $stmt->execute([$usern]);



 if ($stmt->rowCount() == 1) {
     $user = $stmt->fetch();

     if (password_verify($pass, $user['password'])) {
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['ime'] = $user['ime'];
         $_SESSION['priimek'] = $user['priimek'];
         $_SESSION['slika'] = $user['slika_profila'];
         $_SESSION['email'] = $user['email'];
         $query2 = "UPDATE uporabniki SET active=1 WHERE id=?";
         $stmt2 = $pdo->prepare($query2);
         $stmt2->execute([$user['id']]);
         //$_SESSION['admin'] = $user['admin'];

         $_SESSION['last_login_timestamp'] = time();

         header("Location: ../index.php");
         echo 'uspesna prijava';
         die;
       }else{
         header("Location: ../login-form.php?error=Password is Incorect&un=$usern");
	        exit();
       }
   }
}


header("Location: ../login-form.php?error=Username is Incorect");
echo 'neuspesna prijava';
?>
