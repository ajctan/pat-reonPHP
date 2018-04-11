<?php
	include 'dbh.php';
	session_start();
	$uPassOld = $_POST['oldpw'];

	$encOldPW = /*encrypt old password*/"";

	if($_POST['newpw1'] != $_POST['newpw2']){
		$_SESSION['error'] = 2;
		header("Location: ../page/settings.php");
	}

	$sql = $conn->prepare("select count(*) from users where userid=? and password=?");
	$sql->bind_param("is",$_SESSION['uID'],$encOldPW);
	$sql->execute();
	$res = $sql->get_result();
    $row = $res->fetch_assoc();

    if($row['count(*)'] == 0){
    	$_SESSION['error'] = 2;
    	header("Location: ../page/settings.php");
    }


	/*encrypt shit here*/
	$encNewPW = ""; /*encrypted password*/

	$sql = $conn->prepare("update users set password=? where userid=?");
	$sql->bind_param("si",$encNewPW,$_SESSION['uID']);
	$sql->execute();

        $getULO = $conn->prepare("select * from users where userid > 1 and username like ?");
        $getULO->bind_param("s",$_SESSION['uName']);
        $getULO->execute();

        $reLO = $getULO->get_result();
        $roLO = $reLO->fetch_assoc();

        $logStringLO =session_id().":"."Changed Password. ".$_GET['id']." ".date('m/d/Y h:i:s a', time());

        $file = fopen("test.txt","at");
        $txtLogString = "(".$_SESSION['uName'].")".$roLO['userid']." ".$logStringLO."\n";
        fwrite($file,$txtLogString);
        fclose($file);

	header("Location: ../page/settings.php");
    exit;
?>