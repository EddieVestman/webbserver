<?php
$str="";

	if (isset($_GET['username'])) {
			$usr=$_GET['username'];
			$str="Användarnamnet $usr upptaget";
		}
		elseif(isset($_GET['email'])) {
				$ma=$_GET['email'];
				$str="Mailadressen $ma är upptagen";
		}
		
	if(!empty($_POST['firstname'])&& !empty($_POST['lastname'])&& !empty($_POST['email'])&& !empty($_POST['adress'])&& !empty($_POST['zip'])&& !empty($_POST['city'])
		 && !empty($_POST['phone'])&& !empty($_POST['username'])&& !empty($_POST['password'])) 
	{
		$firstname = filter_input(INPUT_POST,'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$lastname = filter_input(INPUT_POST,'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
		$adress = filter_input(INPUT_POST,'adress', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$zip = filter_input(INPUT_POST,'zip', FILTER_SANITIZE_NUMBER_INT);
		$city =  filter_input(INPUT_POST,'city', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$phone = filter_input(INPUT_POST,'phone', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
			
		require "../includes/connect.php";
		
		$hashedPassword = password_hash($password,1);
		$sql="SELECT * FROM users WHERE username = ? OR email = ?";
		$res=$dbh->prepare($sql);
		$res->bind_param("ss",$username, $mail);
		$res->execute();
		$result=$res->get_result();
		$row=$result->fetch_assoc();
		
		if($row !== NULL)
		{
			if($row['username']=== $username) {
				header("location:createUser.php?name=$username");
			}
			elseif($row['email'] === $email) {
				header("location;createUser.php?email=$email");
			}
		}
		
		else
		{
			$status = 1;
			$sql = "INSERT INTO users(username, email, password, status) VALUE (?,?,?,?)";
			$res=$dbh->prepare($sql);
			$res->bind_param("sssi",$username, $email, $hashedPassword, $status);
			$res->execute();
			
			$sql = "INSERT INTO customers(username, firstname, lastname, adress, zip, city, phone) VALUE (?,?,?,?,?,?,?)";
			$res=$dbh->prepare($sql);
			$res->bind_param("ssssiss",$username, $firstname, $lastname, $adress, $zip, $city, $phone);
			$res->execute();
			$str="Användaren tillagd";
		}
	}
	else
	{
		$str.=<<<FORM
		<form action="createUser.php" method="post">
            <p><label for="firstname">Förnamn:</label>
            <input type="text" id="firstname" name="firstname"></p>
			<p><label for="lastname">Efternamn:</label>
			<input type="text" id="lastname" name="lastname"></p>
			<p><label for="email">Epost:</label>
			<input type="email" id="email" name="email"></p>
			<p><label for="adress">Adress:</label>
			<input type="text" id="adress" name="adress"></p>
			<p><label for="zip">Postnummer:</label>
			<input type="text" id="zip" name="zip"></p>
			<p><label for="city">Postort:</label>
			<input type="text" id="city" name="city"></p>
			<p><label for="phone">Telefon Nummer:</label>
			<input type="text" id="phone" name="phone"></p>
			<p><label for="username">Användarnamn:</label>
            <input type="text" id="username" name="username"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="password"></p>
            <p>
            <input type="submit" value="Skapa användare">
            </p>
          </form>
FORM;
	}
?>

<!DOCTYPE html>

<html lang="sv">

  <head>
     <meta charset="utf-8">
     <title>Logga in</title>
		 <link rel="stylesheet" href="css/stilmall.css">
	</head>
  <body id="login">
    <div id="wrapper">
     	<header><!--Sidhuvud-->
            <h1>Min onlinebutik - Logga in</h1>
      </header>
      
      <?php
		//require "masthead.php";
		//require "menu.php";
		?>
		
			<main> <!--Huvudinnehåll-->
				<section>
					<?php 
						echo "$str"; 
					?>
				</section>
			</main>
    </div>
    <?php	
		//require "footer.php";
	?>

	</body>
</html>