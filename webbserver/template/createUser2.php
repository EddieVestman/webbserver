<?php
	$fname = filter_input(INPUT_POST,'fname', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	$ename = filter_input(INPUT_POST,'ename', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	$mail = filter_input(INPUT_POST,'mail', FILTER_SANITIZE_EMAIL);
	$adress = filter_input(INPUT_POST,'adress', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	$zip = filter_input(INPUT_POST,'zip', FILTER_SANITIZE_NUMBER_INT);
	$ort = filter_input(INPUT_POST,'ort', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	$nummer = filter_input(INPUT_POST,'nummer', FILTER_SANITIZE_NUMBER_INT);
	$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	
	echo $fname;
	echo "<br>";
	echo $ename;
	echo "<br>"
	echo $mail;
	echo "<br>";
	echo $adress;
	echo "<br>";
	echo $zip;
	echo "<br>";
	echo $ort;
	echo "<br>"
	echo $nummer;
	echo "<br>";
	echo $password;
	
?>
