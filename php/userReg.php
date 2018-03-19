<?php
	include 'dbh.php';
	if($_POST['regPassword'] != $_POST['regCheckPW']){
		echo "<script type='text/javascript'>alert(\"Passwords do not match!\");</script>";
		header("Location: ../html/signup.php");
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
			$sql->bind_param("issss",$uRegCat,$_POST['regUserName'],$_POST['regEMail'],$_POST['regPassword'],$catStr);
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

		header("Location: ../page/index.php");
		exit;
	}
?>