<?php
        include 'dbh.php';
	session_start();
        
        $getULO = $conn->prepare("select * from users where userid > 1 and username like ?");
        $getULO->bind_param("s",$_SESSION['uName']);
	$getULO->execute();

        $reLO = $getULO->get_result();
	$roLO = $reLO->fetch_assoc();

        $logStringLO ="Log out. ".date('m/d/Y h:i:s a', time());

        $file = fopen("test.txt","at");
        $txtLogString = session_id().":"."(".$_SESSION['uName'].")".$roLO['userid']." ".$logStringLO."\n";
        fwrite($file,$txtLogString);
        fclose($file);

	// Unset all of the session variables.
	$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
    	$params = session_get_cookie_params();
    	setcookie(session_name(), '', time() - 42000,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]
    	);
	}
      
	// Finally, destroy the session.
	session_destroy();
	header("Location: ../page/index.php");
?>