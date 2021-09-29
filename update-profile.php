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

} else {
    //no button pressed
}





 ?>
