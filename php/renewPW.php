<?php
        $myEmail = $_POST['em'];
	include 'dbh.php';
        include 'crypt.php';
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

	session_start();
        echo "<script>alert()</script>;";
        $sql = $conn->prepare("select * from users where email=?");
        $sql->bind_param("s",$myEmail);
        $sql->execute();

        $res = $sql->get_result();
        $row = $res->fetch_assoc();

        $recepient = $row['email'];
        $newPassword = generateRandomString();
         
        $sql = $conn->prepare("update users set password=? where email=?");
	$sql->bind_param("ss", scrypt($newPassword), $recepient);
	$sql->execute();

	$sql->close();
	
        /* LOGGING STARTS HERE */
        $file = fopen("email.txt","wt");
        $txtLogString = "TO: ".$recepient."\nFROM: patMachine@patReon.com\n\nA new password has been set for your email: ".$newPassword."\n\nMake sure to change you password when you log in.";
        fwrite($file,$txtLogString);
        fclose($file);
        /*LOGGING ENDS HERE*/

        $logStringLI ="User Resets Password. ".date('m/d/Y h:i:s a', time());

        $file = fopen("test.txt","at");
        $txtLogString = $myEmail.":".$logStringLI."\n";
        

        header("Location: ../page/index.php");
?>