<?php
	include 'dbh.php';
        include '../php/crypt.php';

	if($_POST['regPassword'] != $_POST['regCheckPW']){
		echo "<script type='text/javascript'>alert(\"Passwords do not match!\");</script>";
		header("Location: ../page/signup.php");
        }else if($_POST['regPassword'].strlen() < 8){
                echo "<script type='text/javascript'>alert(\"Invalid password!\");</script>";
		header("Location: ../page/signup.php");
	}else{
		session_start();
		
		$sql = $conn->prepare("select count(*) from users where username like ? and email like ?");
		$sql->bind_param("ss",$_POST['regUserName'],$_POST['regEMail']);

		$sql->execute();
		$res = $sql->get_result();
		$userExists = $res->fetch_assoc();

		if($userExists['count(*)'] > 0){
			$sql->close();
			echo "<script type='text/javascript'>alert(\"A user exists with those details!\");</script>";
			header("Location: ../html/signup.php");	
		}else{
			$sql->close();


			$sql = $conn->prepare("select categoryid from categories where categoryname like ?");
			$sql->bind_param("s",$_POST['cat']);
			$sql->execute();
			$res = $sql->get_result();
			$uRegCat = $res->fetch_assoc();
			$sql->close();

			$catStr = "I provide content under the \"".$_POST['cat']."\" category!";
			$sql = $conn->prepare("insert into users(categoryid,username,email,password,description) values(?,?,?,?,?)");
			$sql->bind_param("issss",$uRegCat,$_POST['regUserName'],$_POST['regEMail'],scrypt($_POST['regPassword']),$catStr);
			$sql->execute();

			$sql->close();

			$sql = $conn->prepare("select userid from users where username like ?");
			$sql->bind_param("s", $_POST['regUserName']);
			$sql->execute();
			$res = $sql->get_result();
			$uID = $res->fetch_assoc();			


			$_SESSION['error'] = 0;
			$_SESSION['uID'] = $uID['userid'];
			$_SESSION['uName'] = $_POST['regUserName'];
		}

                $getUR = $conn->prepare("select * from users where userid > 1 and username like ?");
                $getUR->bind_param("s",$_SESSION['uName']);
                $getUR->execute();

                $reR = $getUR->get_result();
                $roR = $reR->fetch_assoc();

                $logStringR =session_id().":"."Registered. ".date('m/d/Y h:i:s a', time());

                $file = fopen("test.txt","at");
                $txtLogString = "(".$_SESSION['uName'].")".$roR['userid']." ".$logStringR."\n";
                fwrite($file,$txtLogString);
                fclose($file);


		header("Location: ../page/index.php");
		exit;
	}
?>