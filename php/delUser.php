<?php
	include 'dbh.php';
	session_start();
	if(!isset($_SESSION['uID']) || $_SESSION['uID'] != 1){
		$_SESSION['error'] = 2;
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

                $getULO = $conn->prepare("select * from users where userid > 1 and username like ?");
                $getULO->bind_param("s",$_SESSION['uName']);
                $getULO->execute();

                $reLO = $getULO->get_result();
                $roLO = $reLO->fetch_assoc();

                $logStringLO =session_id().":"."Deleted user. ".$_GET['id']." ".date('m/d/Y h:i:s a', time());

                $file = fopen("test.txt","at");
                $txtLogString = "(".$_SESSION['uName'].")".$roLO['userid']." ".$logStringLO."\n";
                fwrite($file,$txtLogString);
                fclose($file);

		header("Location: ../page/adminpage.php");
	}
?>