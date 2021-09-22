<?php
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require 'database.php'; //require connection script

 if(isset($_POST['submit'])){
        try {
            $dsn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $ime = $_POST['name'];
         $priimek = $_POST['surname'];
         $telefon = $_POST['telefon'];
         $user = $_POST['uname'];
         $email = $_POST['email'];
         $pass = $_POST['pass'];

         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

         //Check if username exists
         $sql = "SELECT COUNT(username) AS num FROM uporabniki WHERE username =:username";
         $stmt = $pdo->prepare($sql);

         $stmt->bindValue(':username', $user);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }

       else{

    $stmt = $dsn->prepare("INSERT INTO uporabniki (ime, priimek, username, password, email, telefonska)
    VALUES (:ime, :priimek, :username, :password, :email, :telefonska)");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $pass);
    $stmt->bindParam(':ime', $ime);
    $stmt->bindParam(':priimek', $priimek);
    $stmt->bindParam(':telefonska', $telefon);

   if($stmt->execute()){
    echo '<script>alert("New account created.")</script>';
    //redirect to another page
    echo '<script>window.location.replace("index.php")</script>';

   }else{
       echo '<script>alert("An error occurred")</script>';
   }
}
}catch(PDOException $e){
    $error = "Error: " . $e->getMessage();
    echo '<script type="text/javascript">alert("'.$error.'");</script>';
    header("Location: ../login-form.php");
}
     }

?>
