<?php
session_start();
include_once 'database.php';
$uname = $_POST['uname'];
$pass = $_POST['pass'];

//preverim, če sem prejel podatke

if (!empty($uname) && !empty($pass)) {
    //$pass = sha1($pass.$salt);

    $query = "SELECT * FROM uporabniki WHERE username=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$uname]);

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['admin'] = $user['admin'];
            header("Location: ../index.php");
            die();
        }
    }
}
header("Location: ../login-form.php");
?>
