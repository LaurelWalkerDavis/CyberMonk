<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Account page for the CyberMonk website. 
It uses ".css" for formatting.

ASSOCIATED FILES
Header.html			Welcome.php			Examen.php					contemplation.txt
BackBar.html		Login.php			ExamenSubmit.php			examen.txt
Footer.html			Account.php			Contemplation.php			lectio.txt
Navigation.php		Logout.php			ContemplationSubmit.php		monks.txt
index.php			Leaving.php			LifeReview.php				Design.css
Signup.php			LectioDivina.php	contemplation-images.json	
Landing.php			LectioSubmit.php	psalms.txt					
---------------------------------------------------------------------------------------->
<?php include("Header.html"); ?>
<?php include("Navigation.php"); ?>

<?php error_reporting(E_ALL);
ini_set('display_errors', '1'); ?>

<!------------HEADER----------------->


<!------------PROCESS USER----------------->

<?php
/************* OBTAIN NEW USER INFORMATION FROM FORM *************/

	$monkAccount = array(						// create a $monkAccount array of named variables
			"email" => $_POST["email"],
			"first_name" => $_POST["first_name"],
			"last_name" => $_POST["last_name"],
			"password" => $_POST["password"],
			"passwordConf" => $_POST["passwordConf"],
			"signup_date" => $_POST["signup_date"]
	);
	
	/****** APPEND TO MONKS.TXT *******/
		$monkAccountString = implode(",", $monkAccount) . PHP_EOL;
		
		file_put_contents("monks.txt", $monkAccountString, FILE_APPEND);	// write $monkAccount to "monks.txt"

	/****** SET NEWUSER AS SESSION MONK *******/
		$_SESSION['user'] = $monkAccount;	// set as session
		$monk = $_SESSION['user'];
		
?>

<!----------- WELCOME SECTION ----------->

<div class=content-container>
	<div class="welcome">
		<h3>Welcome to CyberMonk, <span class="monk"><?= $monk["first_name"] ?>!</span></h3><br/>
			<p>
				Now, <a href="Login.php"><span id="link">log in</span></a> to get started!
			</p>
	</div>
</div>


<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
