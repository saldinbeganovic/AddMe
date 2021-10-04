<?php
include_once 'functions/session.php';
include 'functions/function.php';
require 'functions/database.php';
$user = get_user();


if (isset($_POST['image_button'])) {
    //update slike
    $target_dir = "uploads/profile_pictures/";
    $user_id = $user['id'];
    $prefix_name = $user['username'] ;
    $target_file = $target_dir .$prefix_name. basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //vse je ok, zapišemo v bazo
          $query = "UPDATE uporabniki SET slika_profila=? WHERE id=?";
          $stmt = $pdo->prepare($query);
          $stmt->execute([$target_file,$user_id]);

          header("Location: edit-profile.php");
          die();

    }}

} else if (isset($_POST['update_button'])) {
    //update celega profila
    //slika_profila
    $target_dir = "uploads/profile_pictures/";
    $user_id = $user['id'];
    $prefix_name = $user['username'] ;
    $target_file = $target_dir .$prefix_name. basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //vse je ok, zapišemo v bazo
          $query1 = "UPDATE uporabniki SET slika_profila=? WHERE id=?";
          $stmt1 = $pdo->prepare($query1);
          $stmt1->execute([$target_file,$user_id]);



    }}

    //druge stvari

    $ime=$_POST['ime'];
    $username1 = $_POST['uime'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $priimek = $_POST['priimek'];
    $bio=$_POST['bio'];

    $query = "UPDATE uporabniki SET ime=?,priimek=?,username=?,email=?,telefonska=?,opis_profila=? WHERE id=?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$ime,$priimek,$username1,$email,$tel,$bio,$user_id]);

    header("Location: edit-profile.php");
    die();
} else {
    //no button pressed
}





 ?>
