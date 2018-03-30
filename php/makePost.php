<?php
	include 'dbh.php';
	session_start();

	if(isset($_FILES['fileToUpload']) && $_POST['message'] != ''){
		$image = $_FILES['fileToUpload']['tmp_name'];
		$ext = pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION);
        //$contImg = addslashes(file_get_contents($image));
		$null = NULL;
        $sql = $conn->prepare("insert into contents(userid,content_file,content_message,content_level,content_ext) values(?,?,?,?,?)");
		$sql->bind_param("ibsis",$_SESSION['uID'],$null,$_POST['message'],$_POST['cat'],$ext);
		$sql->send_long_data(1,file_get_contents($image));
		$sql->execute();

		header("Location: ../page/profile.php?un=".$_SESSION['uName']);
	}else{
		//echo "<script>alert('".$_FILES['fileToUpload']."')</script>";
		header("Location: ../page/post.php");
	}
?>