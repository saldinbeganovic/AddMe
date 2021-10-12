<?php
    include 'database.php';
    include_once 'session.php';
    include "function.php";

    $objava_id=$_POST['objava_id'];
    $uid=$_POST['uporabnik_id'];
    $x=$_POST['article_id'];

   if(!likedByMe($objava_id))
   {

    $query = 'INSERT INTO lajki (uporabnik_id,objava_id) VALUES (?,?)';
    $pdo->prepare($query)->execute([$uid, $objava_id]);
    header("Location: ../index.php#$x");

  }else {

    $query = "DELETE FROM lajki WHERE uporabnik_id = ? AND objava_id=?";
    $stmt = $pdo->prepare($query);
    $pdo->prepare($query)->execute([$uid, $objava_id]);


     header("Location: ../index.php#$x");

  }




















 ?>
