<?php

include_once 'functions/session.php';
include 'functions/function.php';
require 'functions/database.php';
$user = get_user();

    //update slike
    $target_dir = "uploads/";
    $user_id = $user['id'];
    $path="post_";
    $prefix_name = $user['username'] ;
    $target_file = $target_dir.$path .$prefix_name."_". basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imeslike=$user['username']."_post";
    date_default_timezone_set("Europe/Ljubljana");
    $dt=date('Y-m-d H:i:s');

    $opis=$_POST['bio'];
    $tags=$_POST['tags'];

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $uploadOk = 0;
        header("Location:create_post.php?error=Image size is to big!");
         exit();
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
        header("Location:create_post.php?error=File format is not supported! Please choose file format:jpg, png, jpeg, gif");
         exit();
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //vse je ok, zapišemo v bazo
          $query = "INSERT INTO objave(ime,opis,path,uporabnik_id,datum_objave) "
                  . "VALUES(?,?,?,?,?)";
          $stmt = $pdo->prepare($query);
          $stmt->execute([$imeslike,$opis,$target_file,$user_id,$dt]);

          header("Location: index.php");
          die();}}










?>
