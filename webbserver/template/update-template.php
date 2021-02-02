<?php
	require('../includes/connect.php');
	session_start();

	$oldPassword = filter_input(INPUT_POST, 'oldPass', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$newPassword = filter_input(INPUT_POST, 'newPass', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

	$oldHashedPassword = password_hash($oldPassword, 1);
	$newHashedPassword = password_hash($newPassword, 1);
	
	$sql = "SELECT password FROM webbshop.user WHERE username=?";
	$res = $dbh->prepare($sql);
	$res->bind_param("s",$_SESSION['username']);
	$res->execute();

	$result = $res->get_result();
	$row=$result->fetch_assoc();
	if(!$row){
		header('Location: logout.php');
	}
	else{
		if(password_verify($oldPassword, $row['password'])){
			$sql = "UPDATE webbshop.user SET password = ? WHERE username = ?";
			$res = $dbh->prepare($sql);
			$res->bind_param("ss",$newHashedPassword, $_SESSION['username']);
			if($res->execute()){
				header('Location: user.php');
			}
			else{
				header('Location: user.php?Error=2');
			}
			
		}
		else{
			echo "failed to loggin";
			header('Location: user.php?Error=1');
		}
	}

	$conn->close();
?>
