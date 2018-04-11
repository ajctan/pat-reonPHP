<?php
	include 'dbh.php';
	session_start();

	if(!isset($_SESSION['uID']))
		header("Location: ../page/index.php");

	$getUN = $conn->prepare("select * from users where userid > 1 and username like ?");
	$getUN->bind_param("s",$_COOKIE['stun']);
	$getUN->execute();

	$res = $getUN->get_result();
	$row = $res->fetch_assoc();

	$subto = $row['userid'];

	$sqlSub = $conn->prepare("insert into subs(userid,subbedtoid,sublevel) values(?,?,?)");
	$sqlSub->bind_param("iii",$_SESSION['uID'],$subto,$_COOKIE['stype']);
	$sqlSub->execute();

	$getUS = $conn->prepare("select * from users where userid > 1 and username like ?");
        $getUS->bind_param("s",$_SESSION['uName']);
	$getUS->execute();

        $reS = $getUS->get_result();
	$roS = $reS->fetch_assoc();
        
        /* LOGGING STARTS HERE */
        $logStringS = "(".$_SESSION['uName'].")".$roS['userid']." pats ".$subto." ".date('m/d/Y h:i:s a', time());

        $sqlLogS = $conn->prepare("insert into archive(sessionID,userid,log) values(?,?,?)");
        $sqlLogS->bind_param("sis",session_id(),$roS['userid'],$logStringS);
        $sqlLogS->execute();
        mysqli_close($conn);

        $file = fopen("test.txt","at");
        $txtLogString = session_id().":"."(".$_SESSION['uName'].")".$roS['userid']." ".$logStringS."\n";
        fwrite($file,$txtLogString);
        fclose($file);
        /*LOGGING ENDS HERE*/


	header("Location: ../page/profile.php?un=".$_COOKIE['stun']);
?>