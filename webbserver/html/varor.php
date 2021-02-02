<?php
	require "../includes/connect.php";
	$sql = "SELECT * FROM products";
		
	$res = $dbh->prepare($sql);
	$res->execute();
	$result = $res->get_result();
	$dbh->close();
?>
