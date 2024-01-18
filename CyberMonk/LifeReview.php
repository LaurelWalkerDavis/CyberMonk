<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Life Review page for the CyberMonk website. 
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
/****** GET MONK FROM SESSION *******/

if (isset($_SESSION['user'])) {
    // Access user data
    $monk = $_SESSION['user'];
} else {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.php"); // Redirect to the login page, for example
    exit();
}

/****** OBTAIN ACCOUNT INFORMATION FROM MONK *******/
$monkEmail = $monk['email'];
$monkPass = $monk['password'];


/****** GET MONK RECORD FROM LECTIO FILE *******/
$fileName = 'lectio.txt';
$reflectionType = "Lectio Divina";

$monkLectioRecord = getReflectionsFromFile($fileName, $monkEmail, $reflectionType);
$monkLectioRecord = getReflectionsToDisplay($monkLectioRecord);

/****** GET MONK RECORD FROM EXAMEN FILE *******/
$fileName = 'examen.txt';
$reflectionType = "Examen";

$monkExamenRecord = getReflectionsFromFile($fileName, $monkEmail, $reflectionType);
$monkExamenRecord = getReflectionsToDisplay($monkExamenRecord);

/****** GET MONK RECORD FROM CONTEMPLATION FILE *******/
$fileName = 'contemplation.txt';
$reflectionType = "Contemplation";

$monkContemplationRecord = getReflectionsFromFile($fileName, $monkEmail, $reflectionType);
$monkContemplationRecord = getReflectionsToDisplay($monkContemplationRecord);


/****** OBTAIN REFLECTIONS RECORD FROM FILE *******/
function getReflectionsFromFile($fileName, $monkEmail, $reflectionType) {
	$data = file($fileName);		// $data is an array of lectio records
	$data = array_map("trim", $data);	// remove any whitespace

	foreach ($data as $attributes) {
		$record = explode(",", $attributes);	// separate data at ","
		$email = $record[0];
		
		if ($email == $monkEmail) {
			return $record;
		}
	}
		// If this is the first reflection entry, create new record
		return "You haven't completed any " . $reflectionType . " exercises yet.";
}

/****** FORMAT REFLECTIONS FOR DISPLAY *******/
function getReflectionsToDisplay($reflectionRecords) {
		if(gettype($reflectionRecords) == "string")
		{
			return $reflectionRecords;
		}
		// remove email from record
		$recordEmail = array_shift($reflectionRecords);

		$count = count($reflectionRecords);
		$recordString = ""; // initialize as an empty string

		for ($i = 0; $i < $count; $i += 3) {
			$day = $reflectionRecords[$i];
			$date = $reflectionRecords[$i + 1];
			$entry = $reflectionRecords[$i + 2];
			// Concatenate the formatted entry to the $recordString
			$recordString .= $day . ', ' . $date . $entry . "<br/>";
		}
		return($recordString);
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
<div class=content-container>
		<div>
			<h3>Your life review, <span class="monk"><?= $monk["first_name"] ?></span></h3><br/>
				
				<h4> Lectio Divina </h4>
				 <p class="life-review">
					<?= $monkLectioRecord ?>
				</p></br></br>
				
				
				<h4> Examen </h4>
				 <p class="life-review">
					<?= $monkExamenRecord ?>
				</p></br></br>
				
				<h4> Contemplation </h4>
				 <p class="life-review">
					<?= $monkContemplationRecord ?>
				</p>
		</div>

	</div>

<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
