<?php
    include 'database.php';
    include_once 'session.php';
    $objava_id=$_GET['oid'];

    $komentarDelete = "DELETE FROM komentarji WHERE  objava_id=?";
    $stmt1 = $pdo->prepare($komentarDelete);
    $pdo->prepare($komentarDelete)->execute([$objava_id]);

    $likeDelete = "DELETE FROM lajki WHERE  objava_id=?";
    $stmt2 = $pdo->prepare($likeDelete);
    $pdo->prepare($likeDelete)->execute([$objava_id]);

    $objavaDelete = "DELETE FROM objave WHERE id=?";
    $stmt3 = $pdo->prepare($objavaDelete);
    $pdo->prepare($objavaDelete)->execute([$objava_id]);

    header("Location: ../index.php");
