<?php
	include 'dbh.php';
	session_start();
	$uName = $_POST['name'];

	$sql = $conn->prepare("update users set username=? where userid=?");
	$sql->bind_param("ss",$uName,$_SESSION['uID']);
	$sql->execute();
	$_SESSION['uName'] = $uName;

	header("Location: ../page/settings.php");
    exit;
?>