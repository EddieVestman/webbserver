<?php
	$dbh = new mysqli("localhost", "dbUser", "qwe123", "webbshop");
	
	if(!$dbh) {
		echo "Ingen kontakt med databasen";
		exit;
	}

?>