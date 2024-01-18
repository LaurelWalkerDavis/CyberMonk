<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Examen - SUBMIT page for the CyberMonk website. 
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

/****** OBTAIN EXAMEN INPUT FROM THE FORM *******/
$consolationInput = $_POST['newConsolation'];
$desolationInput = $_POST['newDesolation'];
$reflection_type = $_POST['reflection_type'];


/****** OBTAIN ACCOUNT INFORMATION FROM EXAMEN.TXT FILE *******/
$fileName = 'examen.txt';
$monkEmail = $monk['email'];
$monkPass = $monk['password'];


/****** FORMAT NEW REFLECTION *******/
$newConsolation = "Consolation - " . date('l, F j, Y') . ": " . $consolationInput;
$newDesolation = "Desolation - " . date('l, F j, Y') . ": " . $desolationInput;


/****** GET MONK RECORD FROM EXAMEN FILE *******/
$monkExamenRecordOrig = getReflectionsFromFile($fileName, $monkEmail);
$monkExamenRecordOrigString = implode(",", $monkExamenRecordOrig);

/****** APPEND NEW REFLECTION TO EXAMEN RECORD *******/
$monkExamenRecord = $monkExamenRecordOrig;
$monkExamenRecord[] = $newConsolation;
$monkExamenRecord[] = $newDesolation;
$updatedExamenString = implode(",", $monkExamenRecord);

/****** WRITE TO EXAMEN.TXT *******/
$contents = file_get_contents($fileName);
if(str_contains($contents, $monkExamenRecordOrigString))
{
	$contents = str_replace($monkExamenRecordOrigString, $updatedExamenString, $contents);
	file_put_contents($fileName, $contents);
} else 
{
	file_put_contents($fileName, "\n".$updatedExamenString, FILE_APPEND);
}


/****** REDIRECT BACK TO EXAMEN *******/
header("Location: Examen.php");
exit();


/****** OBTAIN RECORD FROM EXAMEN.TXT FILE *******/
function getReflectionsFromFile($fileName, $monkEmail) {
	$data = file($fileName);		// $data is an array of examen records
	$data = array_map("trim", $data);	// remove any whitespace

	foreach ($data as $attributes) {
		$record = explode(",", $attributes);	// separate data at ","
		$email = $record[0];
		
		if ($email == $monkEmail) {
			return $record;
		}
	}
		// If this is the first examen entry, create new record
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
