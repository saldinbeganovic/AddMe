<?php
include_once "session.php";
session_destroy();
header("Location: ../login-form.php");
?>
