<?php

//index.php
include '../functions/database.php';
include('config.php');

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=id,name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();


$id=$facebook_user_info->getId();
$ime=$facebook_user_info->getName();
$email=$facebook_user_info->getEmail();
$picture='https://graph.facebook.com/'.$id.'/picture';

 $get_user = "SELECT * FROM uporabniki WHERE facebook_id=?";


   $user = $pdo->prepare($get_user);
   $user->execute([$id]);
   $google_id = $user->fetch();

   $stmt = $pdo->prepare("SELECT * FROM uporabniki WHERE facebook_id=?");
   $stmt->execute([$id]);
   $userExists = $stmt->fetchColumn();


   if($userExists){
       //echo $id;
       $_SESSION['user_id'] = $google_id['id'];
       $_SESSION['username'] = $google_id['username'];
       $query2 = "UPDATE uporabniki SET active=1 WHERE id=?";
     $stmt2 = $pdo->prepare($query2);
     $stmt2->execute([$_SESSION['user_id']]);
       header('Location: ../index.php');
       exit;


 }
 else{

     // if user not exists we will insert the user
    $username=preg_replace('/[ ]+/', '.', trim($ime));
     $insert = 'INSERT INTO uporabniki(facebook_id,ime,username,email,slika_profila) VALUES (?,?,?,?,?)';
     $pdo->prepare($insert)->execute([$id,$ime,$username,$email,$picture]);

     $googleId = "SELECT * FROM uporabniki WHERE facebook_id=?";
     $google = $pdo->prepare($googleId);
     $google->execute([$id]);
     $user = $google->fetch();
     $_SESSION['user_id'] = $user['id'];
     $_SESSION['username'] = $user['username'];
    $query2 = "UPDATE uporabniki SET active=1 WHERE id=?";
     $stmt2 = $pdo->prepare($query2);
     $stmt2->execute([$_SESSION['user_id']]);

    header('location:../index.php');

 }
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('https://addme.saldinbeganovic.si/facebook-login/login.php', $facebook_permissions);

    // Render Facebook login button
    header('Location:'.$facebook_login_url);
}
