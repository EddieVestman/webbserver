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
  <body id="sida3">
    <div id="wrapper">
			<?php
		require "masthead.php";
		require "menu.php";
		//require "varor.php";
		
		?>	
			
			<main> <!--Huvudinnehåll-->
				<section id="content">
					<h2>Varor</h2>
					<?php
				while($row=$result->fetch_assoc()) {
					echo <<<FIGURE
					<figure>
						<img src="{$row['picture']}" alt="{$row['description']}">
						<figcaption>{$row['name']} {$row['price']}
							<p>
								<a href="#">Köp</a>
							</p>
						</figcaption>
					</figure>
FIGURE;
				}
			?>
            
			</section>
				
				
			</main>
			
			<aside id="aside">
				   <p>News</p>
			</aside>
		</div>
		<!--Egen fil -->
    <?php
		require "footer.php";
		?>
  </body>
</html>
