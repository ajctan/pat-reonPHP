<?php
	include 'dbh.php';

	$uName = $_POST['uname'];
	$pWord = $_POST['pword'];
	session_start();
	$_SESSION['error'] = 1;

	$sql = $conn->prepare("select * from users where email=? and password=?");
	$sql->bind_param("ss",$uName,$pWord);

	$sql->execute();
	$res = $sql->get_result();
	$row = $res->fetch_assoc();
	if($row['userid'] != null){

		$_SESSION['error'] = 0;
		$_SESSION['uID'] = $row['userid'];
		$_SESSION['uName'] = $row['username'];
		echo "<script type='text/javascript'>alert(\"".$_SESSION['uID'] = $row['userid']."\");</script>";
	}

	header("Location: ../page/index.php");
    exit;
?>