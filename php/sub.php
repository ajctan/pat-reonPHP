<?php
	include 'dbh.php';
        include 'crypt.php';
	session_start();
if(!isset($_COOKIE['stype']) || !isset($_COOKIE['stun'])){
    $_SESSION['error'] = 2;
    header("Location: ../page/index.php");
}


	if(!isset($_SESSION['uID']))
		header("Location: ../page/index.php");
        $rawPW = $_SESSION['userpw'];
        $encryptPW = scrypt($rawPW);

        $sql = $conn->prepare("select count(*) from users where username=? and password=?");
        $sql->bind_param("ss",$_SESSION['uName'],$encryptPW);
        $sql->execute();

        $res = $sql->get_result();
        $row = $res->fetch_assoc();

        if($row['count(*)'] == 0){
            $_SESSION['error'] = 1;
            header("Location: ../page/payment.php?sid=".$_COOKIE['stype']."&stun=".$_COOKIE['stun']);
        }


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