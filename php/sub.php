<?php
	include 'dbh.php';
	session_start();

	if(!isset($_SESSION['uID']))
		header("Location: ../page/index.php");
	$getUN = $conn->prepare("select * from users where username like ?");
	$getUN->bind_param("s",$_COOKIE['stun']);
	$getUN->execute();

	$res = $getUN->get_result();
	$row = $res->fetch_assoc();

	$subto = $row['userid'];

	$sqlSub = $conn->prepare("insert into subs(userid,subbedtoid,sublevel) values(?,?,?)");
	$sqlSub->bind_param("iii",$_SESSION['uID'],$subto,$_COOKIE['stype']);
	$sqlSub->execute();

	header("Location: ../page/profile.php?un=".$_COOKIE['stun']);
?>