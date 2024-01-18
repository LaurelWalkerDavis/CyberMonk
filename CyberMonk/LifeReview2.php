<!-----------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Life Review page for the CyberMonk website. 
It uses ".css" for formatting.

ASSOCIATED FILES
Design.css			Login.php
Header.html			Account.php
Footer.html			LectioDivina.php
Navigation.php		Examen.php
index.php			Contemplation.php
Signup.php			LifeReview.php
------------------------------------->
<?php include("Header.html"); ?>
<?php include("Navigation.php"); ?>

<?php error_reporting(E_ALL);
ini_set('display_errors', '1'); ?>
<!------------HEADER----------------->

<?php 
///// GET USER UPDATES

// Get the lectio input from the form
$lectioInput = $_POST['newLectio'];
$reflection_type = $_POST['reflection_type'];


///// SAVE USER DATA TO SESSION MONK

	// Check if the 'user' key exists in the session
	if (isset($_SESSION['user'])) {
		// Access user data
		$sessionMonk = $_SESSION['user'];
	} else {
		// redirect to login page
	}

	// Append the input to the 'lectio' array
	$sessionMonk['lectio'][] = "Lectio Divina - " . date('l, F j, Y') . ": " . $lectioInput;

	// Update the user data in the session
	$_SESSION['user'] = $sessionMonk;



///// SAVE USER DATA TO TEXT MONK

$txtMonk = getMonkFromFile(
	"monks.txt", 
	$sessionMonk['account']['email'], 
	$sessionMonk['account']['password'])
	$lectioInput;		// get user data from file

if ($txtMonk !== null) {
	$_SESSION['user'] = $txtMonk;
	$txtMonk = $_SESSION['user'];
} 

function getMonkFromFile($fileName, $monkEmail, $monkPass, $newLectio) {
    $data = file($fileName);        // $data is an array of monks
    $data = array_map("trim", $data);    // remove any whitespace

    foreach ($data as $key => $attributes) {
        $person = explode(",", $attributes);    // separate data at ","
        list($user_email, $first_name, $last_name, $password, $passwordConf, $signup_date, $lectio, $examen, $contemplation) = $person; //breaks list array into separate variables

        if ($user_email == $monkEmail && $password == $monkPass) {
            // Append the new 'lectio' element to the existing 'lectio' array
            $lectioArray = explode("PHP_EOL", $lectio); // PHP_EOL is the delimiter for 'lectio' elements
            $lectioArray[] = $newLectio;
            $lectio = implode("PHP_EOL", $lectioArray);

            // Update the 'lectio' in the array
            $data[$key] = implode(",", array($user_email, $first_name, $last_name, $password, $passwordConf, $signup_date, $lectio, $examen, $contemplation));

            // Write the modified data back to the file
            file_put_contents($fileName, implode(PHP_EOL, $data));

            return array(                // create a $monk array of named variables
                "account" => array(
                    "email" => $user_email,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "password" => $password,
                    "passwordConf" => $passwordConf,
                    "signup_date" => $signup_date
                ),
                "lectio" => array($lectio),
                "examen" => array($examen),
                "contemplation" => array($contemplation)
            );
        }
    }

    return null;    // monk not found in monks.txt
}

?>
<div class=content-container>
		<div class="welcome">
			<h3>Your life review, <span class="monk"><?= $sessionMonk["account"]["first_name"] ?></span></h3><br/>
				<p>
					<?= print_r($sessionMonk) ?> <br/><br/>

				</p>
		</div>
		
				<div class="welcome">
			<h3>Your life review, <span class="monk"><?= $txtMonk["account"]["first_name"] ?></span></h3><br/>
				<p>
					<?= print_r($txtMonk) ?> <br/><br/>

				</p>
		</div>

	</div>

<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
