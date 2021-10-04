<?php
require_once 'vendor/autoload.php';

$gClient = new Google_Client();
$gClient->setClientId("1084902849777-kq73s52850eraic8hkng534c51rqujsr.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("AddME");
$gClient->setRedirectUri("addme.saldinbeganovic.si/index.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");



 ?>
