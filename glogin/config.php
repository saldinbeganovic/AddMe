<?php
  require_once "loging.php";
  include_once '../functions/session.php';
  if (isset($_SESSION['access_token'])) {
      $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
      $_SESSION['access_token'] = $token;
  }else{
      header('Location: ../login-form.php');
      exit();
  }
  if(isset($token["error"]) && ($token["error"] != "invalid_grant")){
      // get data from google
      $oAuth = new Google_Service_Oauth2($gClient);
      $userData = $oAuth->userinfo_v2_me->get();

      $name=$userData->name;
      echo '$name';
  }else{
      header('Location: index.php');
      exit();
  }
  ?>
