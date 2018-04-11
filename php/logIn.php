<?php
	include 'dbh.php';
        include '../php/crypt.php';

	$uName = $_POST['uname'];
	$pWord = scrypt($_POST['pword']);
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

		$getULI = $conn->prepare("select * from users where userid > 1 and username like ?");
        $getULI->bind_param("s",$_SESSION['uName']);
        $getULI->execute();

        $reLI = $getULI->get_result();
        $roLI = $reLI->fetch_assoc();

        $logStringLI ="Logged in. ".date('m/d/Y h:i:s a', time());

        $file = fopen("test.txt","at");
        $txtLogString = session_id().":"."(".$_SESSION['uName'].")".$roLI['userid']." ".$logStringLI."\n";
        fwrite($file,$txtLogString);
        fclose($file);
	}
	header("Location: ../page/index.php");
    exit;
?>