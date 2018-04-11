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

        $getULO = $conn->prepare("select * from users where userid > 1 and username like ?");
        $getULO->bind_param("s",$_SESSION['uName']);
        $getULO->execute();

        $reLO = $getULO->get_result();
        $roLO = $reLO->fetch_assoc();

        $logStringLO ="Changed categories. ".$_GET['id']." ".date('m/d/Y h:i:s a', time());

        $file = fopen("test.txt","at");
        $txtLogString = "(".$_SESSION['uName'].")".$roLO['userid']." ".$logStringLO."\n";
        fwrite($file,$txtLogString);
        fclose($file);

	header("Location: ../page/settings.php");
    exit;
?>