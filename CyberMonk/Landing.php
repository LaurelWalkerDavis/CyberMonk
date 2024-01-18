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

<?php

/****** QUERY PARAMETER *******/
$monkEmail = $_POST["email"];
$monkPass = $_POST["password"];
$fileName = "monks.txt";


/****** OBTAIN ACCOUNT INFORMATION FROM TXT FILE *******/
$monkFound = getMonkFromFile($fileName, $monkEmail, $monkPass);		// get user data from file


function getMonkFromFile($fileName, $monkEmail, $monkPass) {
	$monks = array();
	
	$data = file($fileName);		// $data is an array of monks
	$data = array_map("trim", $data);	// remove any whitespace

	foreach ($data as $attributes) {
		$person = explode(",", $attributes);	// separate data at ","
		list($email, $first_name, $last_name, $password, $passwordConf, $signup_date) = $person; //breaks list array into separate variables
		
		if ($email == $monkEmail && $password == $monkPass) {
			return array(				// create a $monk array of named variables
				"email" => $email,
				"first_name" => $first_name,
				"last_name" => $last_name,
				"password" => $password,
				"passwordConf" => $passwordConf,
				"signup_date" => $signup_date
			);
		}
	}
	return null;	// monk not found in monks.txt
}


/************* DEBUGGING HELP *************/
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>

<!------------ IF MONK ACCOUNT IS FOUND IN MONKS.TXT----------------->

<?php
if ($monkFound !== null) {
	$_SESSION['user'] = $monkFound;
	$monk = $_SESSION['user'];
	?>
		<div class= content-container>
			<p>
				<span class="monk">Hello, <?= $monk["first_name"]?>!</span> <br/><br/>
				You have been a member since <?= $monk["signup_date"] ?>.<br/><br/>
				Email Address: <?= $monk["email"] ?> <br/><br/>
			</p>
		</div>


<!------------ IF MONK ACCOUNT IS NOT FOUND IN MONKS.TXT----------------->

<?php	
} else {
?>
		<div class= content-container>
			<p>
				It seems you haven't yet joined our monastery.<br/><br/>
				But we would love to have you!<br/><br/>
				<a href="Signup.php"><span id="link">Sign up</span></a> to get started!
			</p>
		</div>
<?php
}
?>





<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
