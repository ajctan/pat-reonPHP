<?php
	include 'dbh.php';
	session_start();
	
	$cat = $_POST['cat'];

	$sql = $conn->prepare("select categoryid from categories where categoryname like ?");
	$sql->bind_param("s",$cat);
	$sql->execute();

	$res = $sql->get_result();
	$catID = $res->fetch_assoc();

	$sql->close();

	$sql = $conn->prepare("update users set categoryid=? where userid=?");
	$sql->bind_param("si",$catID,$_SESSION['uID']);
	$sql->execute();

	header("Location: ../page/settings.php");
    exit;
?>