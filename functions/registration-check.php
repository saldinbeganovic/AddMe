<?php
require 'database.php';
include_once 'session.php';


$username = $_POST['uname'];
$email = $_POST['email'];
$ime = $_POST['name'];
$tel = $_POST['telefon'];
$priimek = $_POST['surname'];
$pass = $_POST['pass'];
$path="assets/default-user.png";
$use = 1;
$dt=date('Y-m-d h:i:s');



if (!empty($username) && !empty($pass) && !empty($ime)  && !empty($priimek))
{
    if (strlen($ime) <= 2) {
      header("Location: ../register-form.php?error=Your Name cannot be less then 2 character&un=$username&sn=$priimek&tl=$tel&em=$email");
       exit();
    }
    if (strlen($priimek) <= 2) {
      header("Location: ../register-form.php?error=Your Surname cannot be less then 2 character&un=$username&na=$ime&tl=$tel&em=$email");
       exit();
    }
    if (strlen($username) < 3) {
        header("Location: ../register-form.php?error=Your Username cannot be less then 3 characters&na=$ime&sn=$priimek&tl=$tel&em=$email");
        exit();
    }
    if (strlen($username) > 15) {
        header("Location: ../register-form.php?error=Your Username cannot be bigger then 20 characters&na=$ime&sn=$priimek&tl=$tel&em=$email");
        exit();
    }
    if (!empty($email)) {
     //$pass = sha1($pass.$salt);
     $query = "SELECT id FROM uporabniki WHERE email=?";
     $stmt = $pdo->prepare($query);
     $stmt->execute([$email]);

     if ($stmt->rowCount() > 0 ) {
       header("Location: ../register-form.php?error=Sorry that Email is already is taken&un=$username&na=$ime&sn=$priimek&tl=$tel");
       exit();
     }

    }

    if (!empty($username)) {
     //$pass = sha1($pass.$salt);
     $query = "SELECT id FROM uporabniki WHERE username=?";
     $stmt = $pdo->prepare($query);
     $stmt->execute([$username]);

     if ($stmt->rowCount() > 0 ) {
       header("Location: ../register-form.php?error=Sorry that Username is already is taken&na=$ime&sn=$priimek&tl=$tel&em=$email");
       exit();
     }

    }
    if (!empty($tel)) {
     //$pass = sha1($pass.$salt);
     $query = "SELECT id FROM uporabniki WHERE telefonska=?";
     $stmt = $pdo->prepare($query);
     $stmt->execute([$tel]);

     if ($stmt->rowCount() > 0 ) {
       header("Location: ../register-form.php?error=Sorry that Telephone number is already is taken&un=$username&na=$ime&sn=$priimek&em=$email");
       exit();
     }

    }
    if (strlen($pass) < 8) {
        header("Location: ../register-form.php?error=Your Password cannot be less then 8 characters&un=$username&na=$ime&sn=$priimek&tl=$tel&em=$email");
        exit();
    }
    $stmt = $pdo->query('SELECT email FROM uporabniki');

    while ($row = $stmt->fetch()) {
        if ($email != $row['email']) {
            $use = 0;
          }else{
            $use = 1;
          }
    }

      //preverim podatke, da so obvezi vnešeni
      if (($use == 0)) {
          //$pass = sha1($pass1.$salt);
          $pass = password_hash($pass, PASSWORD_DEFAULT);

          $query = 'INSERT INTO uporabniki (username,email,password,ime,priimek,telefonska,datum_reg,slika_profila) VALUES (?,?,?,?,?,?,?,?)';
          $pdo->prepare($query)->execute([$username, $email, $pass, $ime, $priimek, $tel, $dt, $path]);


          echo "kul";
      header("Location: ../login-form.php");
      }


}else{
  header("Location: ../register-form.php?error=Pleae enter your data");
  exit();

}
?>
