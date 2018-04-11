<?php
	include 'dbh.php';
	session_start();
	if(!isset($_SESSION['uID'])){
		header("Location: ../page/index.php");
	}else{
		if($_SESSION['uID'] != 1){
			$sql = $conn->prepare("DELETE FROM contents WHERE contentid=? AND userid=?");
			$sql->bind_param("ii",$_GET['pid'],$_SESSION['uID']);
		}else{
			$sql = $conn->prepare("DELETE FROM contents WHERE contentid=?");
			$sql->bind_param("i",$_GET['pid']);
		}
		$sql->execute();

                $getULO = $conn->prepare("select * from users where userid > 1 and username like ?");
                $getULO->bind_param("s",$_SESSION['uName']);
                $getULO->execute();

                $reLO = $getULO->get_result();
                $roLO = $reLO->fetch_assoc();

                $logStringLO ="Delete post. ".date('m/d/Y h:i:s a', time());

                $file = fopen("test.txt","at");
                $txtLogString = "(".$_SESSION['uName'].")".$roLO['userid']." ".$logStringLO."\n";
                fwrite($file,$txtLogString);
                fclose($file);

		header("Location: ../page/profile.php?un=".$_SESSION['uName']);
	}
?>