<?php
	include 'dbh.php';
	session_start();
	if(!isset($_SESSION['uID']) || $_SESSION['uID'] != 1){
		header("Location: ../page/index.php");
	}else{
		$sql = $conn->prepare("DELETE FROM contents WHERE userid=?");
		$sql->bind_param("i",$_GET['id']);
		$sql->execute();
		$sql = $conn->prepare("DELETE FROM subs WHERE userid=?");
		$sql->bind_param("i",$_GET['id']);
		$sql->execute();
		$sql = $conn->prepare("DELETE FROM users WHERE userid=?");
		$sql->bind_param("i",$_GET['id']);
		$sql->execute();
		header("Location: ../page/adminpage.php");
	}
?>