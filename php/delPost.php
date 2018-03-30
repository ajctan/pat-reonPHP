<?php
	include 'dbh.php';
	session_start();
	if(!isset($_SESSION['uID'])){
		header("Location: ../page/index.php");
	}else{
		$sql = conn->prepare("DELETE FROM contents WHERE contentid=? AND userid=?");
		$sql->bind_param("ii",$_GET['pid'],$_SESSION['uID']);
		$sql->execute();
		header("Location: ../page/profile.php?un=".$_SESSION['uName']);
	}
?>