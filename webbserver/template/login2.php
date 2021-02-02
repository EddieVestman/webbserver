<?php
	
	if(empty($_POST['username'])||empty($_POST['password'])){
		header("Location:../html/login.php");
	}
	require "../includes/connect.php";
	
	
	$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	
	
	$hashedPassword = password_hash($password,1);
	$sql="SELECT password, status FROM users WHERE username=?";
	$res=$dbh->prepare($sql);
	$res->bind_param("s",$username);
	$res->execute();
	$result=$res->get_result();
	$row=$result->fetch_assoc();
	
	if(!$row){
		header("Location:../html/login.php?status=1");
	}
	else{
		if($hashedPassword === $row['password']){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['status']=$row['status'];
			header("Location:../html/admin.php");
		}
		else{
			header("Location:../html/login.php?status=2");
		}
	}
	
	echo $username;
	echo "<br>";
	
?>