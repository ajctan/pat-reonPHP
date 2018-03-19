<?php
	include 'dbh.php';
	session_start();
	
	$desc = $_POST['desc'];

	$sql = $conn->prepare("update users set description=? where userid=?");
	$sql->bind_param("si",$desc,$_SESSION['uID']);
	$sql->execute();

	header("Location: ../page/settings.php");
    exit;
?>