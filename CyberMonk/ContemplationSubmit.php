<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Contemplation - SUBMIT page for the CyberMonk website. 
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
    header("Location: login.php"); // Redirect to the login page
    exit();
}

/****** OBTAIN CONTEMPLATION INPUT FROM THE FORM *******/
$contemplationInput = $_POST['newContemplation'];
$reflection_type = $_POST['reflection_type'];


/****** OBTAIN ACCOUNT INFORMATION FOR CONTEMPLATION.TXT FILE *******/
$fileName = 'contemplation.txt';
$monkEmail = $monk['email'];
$monkPass = $monk['password'];


/****** FORMAT NEW REFLECTION *******/
$newReflection = "," . date('l, F j, Y') . ": " . $contemplationInput;


/****** GET MONK RECORD FROM CONTEMPLATION FILE *******/
$monkContemplationRecord = getReflectionsFromFile($fileName, $monkEmail);
$monkContemplationRecord = implode(',', $monkContemplationRecord);


/****** APPEND NEW REFLECTION TO CONTEMPLATION RECORD *******/
$updatedContemplationRecordString = $monkContemplationRecord . $newReflection;


/****** WRITE TO CONTEMPLATION.TXT *******/
$contents = file_get_contents($fileName);
if(str_contains($contents, $monkContemplationRecord)) // if monk already has record
{
	$contents = str_replace($monkContemplationRecord, $updatedContemplationRecordString, $contents);
	file_put_contents($fileName, $contents); // replace old record with updated one
} else 
{
	file_put_contents($fileName, "\n".$updatedContemplationRecordString, FILE_APPEND);
}



/****** REDIRECT BACK TO CONTEMPLATION *******/
header("Location: Contemplation.php");
exit();


/****** OBTAIN RECORD FROM CONTEMPLATION.TXT FILE *******/
function getReflectionsFromFile($fileName, $monkEmail) {
	$data = file($fileName);		// $data is an array of contemplation records
	$data = array_map("trim", $data);	// remove any whitespace

	foreach ($data as $attributes) {
		$record = explode(",", $attributes);	// separate data at ","
		$email = $record[0];
		
		if ($email == $monkEmail) {
			return $record;
		}
	}
		// If this is the first contemplation entry, create new record
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
