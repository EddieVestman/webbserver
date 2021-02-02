<?php
require "../includes/connect.php";

$username = $_SESSION['username'];

$sql="SELECT * FROM customers WHERE username=?" ;

$res=$dbh->prepare($sql);
	$res->bind_param("s",$username);
	$res->execute();
	$result=$res->get_result();
	//$row=$result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Admin</title>
		 <link rel="stylesheet" href="css/stilmall.css">
  </head>
  <body id="produkter">
    <div id="wrapper">
    <?php
		require "masthead.php";
		require "menu.php";
	?>		
		<main> 
			<section id="content">
				<h2>Uppgifter</h2>
				<table>
					<thead>
						<tr>
							<th>Namn</th>
							<th>Adress</th>
							<th>Zip</th>
							<th>City</th>
							<th></th>
						</tr>
					</thead>
				<tbody>
				
					<?php
					while($row=$result->fetch_assoc()) {
						echo "<tr><td>";
						echo $row["firstname"];
						echo "</td><td>";
						echo $row["adress"];
						echo "</td><td>";
						echo $row["zip"];
						echo "</td><td>";
						echo $row["city"];
						
						
					}	
				?>
				</tbody>
			</table>
			</section>
		</main>
		<?php
			require "footer.php";
		?>
	</div>
  </body>
</html>
