<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Lectio Divina - SUBMIT page for the CyberMonk website. 
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

if (isset($_SESSION['user'])) {
    // Access user data
    $monk = $_SESSION['user'];
} else {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.php"); // Redirect to the login page, for example
    exit();
}

/****** OBTAIN LECTIO INPUT FROM THE FORM *******/
$lectioInput = $_POST['newLectio'];
$reflection_type = $_POST['reflection_type'];


/****** OBTAIN ACCOUNT INFORMATION FROM LECTIO.TXT FILE *******/
$fileName = 'lectio.txt';
$monkEmail = $monk['email'];
$monkPass = $monk['password'];


/****** FORMAT NEW REFLECTION *******/
$newReflection = "," . date('l, F j, Y') . ": " . $lectioInput;


/****** GET MONK RECORD FROM LECTIO FILE *******/
$monkLectioRecord = getReflectionsFromFile($fileName, $monkEmail);
$monkLectioRecord = implode(',', $monkLectioRecord);	// transform to comma separated string


/****** APPEND NEW REFLECTION TO LECTIO RECORD *******/
$updatedLectioString = $monkLectioRecord . $newReflection;


/****** WRITE TO LECTIO.TXT *******/
$contents = file_get_contents($fileName);
if(str_contains($contents, $monkLectioRecord))
{
	$contents = str_replace($monkLectioRecord, $updatedLectioString, $contents);
	file_put_contents($fileName, $contents);
} else 
{
	file_put_contents($fileName, "\n".$updatedLectioString, FILE_APPEND);
}


/****** REDIRECT BACK TO LECTIO DIVINA *******/
header("Location: LectioDivina.php");
exit();


/****** OBTAIN RECORD FROM LECTIO.TXT FILE *******/

function getReflectionsFromFile($fileName, $monkEmail) {
	$data = file($fileName);		// $data is an array of lectio records
	$data = array_map("trim", $data);	// remove any whitespace

	foreach ($data as $attributes) {
		$record = explode(",", $attributes);	// separate data at ","
		$email = $record[0];
		
		if ($email == $monkEmail) {
			return $record;
		}
	}
		// If this is the first lectio entry, create new record
		return array($monkEmail);
}

/************* DEBUGGING HELP *************/
function debug_to_console($data) {
    $output = $data;
    if (is_array($output)) {
        $output = implode(',', $output);
    }
    echo "<script>console.log(" . json_encode($output) . ");</script>";
}

?>

<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
