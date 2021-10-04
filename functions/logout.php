<?php
include_once "session.php";

include 'database.php';
$query = "UPDATE uporabniki SET active=0 WHERE id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);

session_destroy();
header("Location: ../login-form.php");
?>
