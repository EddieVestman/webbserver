<?php
require "../includes/connect.php";

$sql="SELECT * FROM products";

$res=$dbh->prepare($sql);
$res->execute();
$result=$res->get_result();
$dbh->close();
?>

<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Produkter</title>
		 <link rel="stylesheet" href="css/stilmall.css">
  </head>
  <body id="produkter">
    <div id="wrapper">
    <?php
		require "masthead.php";
		require "menu.php";
		// require "varor.php";
	?>		
		<main> 
			<section id="content">
				<h2>Varor</h2>
				<table>
					<thead>
						<tr>
							<th>Namn</th>
							<th>Beskrivning</th>
							<th>Bild</th>
							<th>Pris</th>
							<th></th>
						</tr>
					</thead>
				<tbody>
				
					<?php
					while($row=$result->fetch_assoc()) {
						echo "<tr><td>";
						echo $row["name"];
						echo "</td><td>";
						echo $row["description"];
						echo "</td><td>";
						echo "<img src='";
						echo $row["picture"];
						echo "'></td><td>";
						echo $row["price"];
						echo "</td></tr>";
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
