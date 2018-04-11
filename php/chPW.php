<?php
	include 'dbh.php';
	session_start();
	$uPassOld = $_POST['oldpw'];

	if($_POST['newpw1'] != $_POST['newpw2']){
		header("Location: ../page/settings.php");
	}


	/*encrypt shit here*/
	$encNewPW = ""; /*encrypted password*/

	$sql = $conn->prepare("update users set password=? where userid=?");
	$sql->bind_param("ss",$encNewPW,$_SESSION['uID']);
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