<?php
	include 'dbh.php';
	session_start();
	$uName = $_POST['name'];

    if($uName === $_SESSION['uName']){
        header("Location: ../page/settings.php");
    }

    $sql = $conn->prepare("select count(*) from users where username = ?");
    $sql->bind_param("s",$uName);
    $sql->execute();
    $res = $sql->get_result();
    $row = $res->fetch_assoc();


    if($row['count(*)'] > 0)
        $_SESSION['error'] = 1;
        header("Location: ../page/settings.php");
    else{
	   $sql = $conn->prepare("update users set username=? where userid=?");
	   $sql->bind_param("ss",$uName,$_SESSION['uID']);
	   $sql->execute();
	   $_SESSION['uName'] = $uName;

            $getULO = $conn->prepare("select * from users where userid > 1 and username like ?");
            $getULO->bind_param("s",$_SESSION['uName']);
            $getULO->execute();

            $reLO = $getULO->get_result();
            $roLO = $reLO->fetch_assoc();

            $logStringLO =session_id().":"."Changed Username. ".$_GET['id']." ".date('m/d/Y h:i:s a', time());

            $file = fopen("test.txt","at");
            $txtLogString = "(".$_SESSION['uName'].")".$roLO['userid']." ".$logStringLO."\n";
            fwrite($file,$txtLogString);
            fclose($file);

	   header("Location: ../page/settings.php");
        exit;
    }
?>