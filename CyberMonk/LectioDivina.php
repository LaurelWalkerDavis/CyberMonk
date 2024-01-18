<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Lectio Divina page for the CyberMonk website. 
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
<!------------HEADER----------------->

<?php // Check if the 'user' key exists in the session
if (isset($_SESSION['user'])) {
    // Access user data
    $monk = $_SESSION['user'];



/************* GET PSALM READING FROM FILE *************/

// Function to get five consecutive lines randomly from psalms.txt
function getRandomVerses($filePath) {
    // Read the file into an array
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);

    // Calculate the maximum index for five consecutive lines
    $maxIndex = count($lines) - 5;

    // Random starting index
    $startIndex = rand(0, $maxIndex);

    // Get five consecutive lines starting from random index
    $selectedVerses = array_slice($lines, $startIndex, 5);

    // Return 5 verses as a string
    return implode("\n", $selectedVerses);
}

// Get five consecutive lines randomly
$randomVerses = getRandomVerses('psalms.txt');
$characters = array("1", "2", "3", "4", "5", "6", "7", "8", "9", ":"); // to remove chapter & verse
$randomVerses = str_replace($characters,"",$randomVerses);	// will make more readable
?>




<div class="content-container">
	<h3>Lectio Divina Exercise for <span class="monk"><?= $monk["first_name"] ?>!</span></h3><br/>
		<p class = "exercise-description">
			Lectio Divina, Latin for "Divine Reading," is a contemplative and prayerful 
			approach to engaging with sacred texts, particularly from the Christian tradition. 
			Rooted in monastic traditions and attributed to early Christian monks, Lectio Divina 
			offers a structured yet flexible framework for individuals seeking a deeper 
			connection with the divine through the sacred words of scripture.<br/><br/>
			Lectio Divina is not a rigid formula but a flexible and personal practice that 
			encourages an intimate encounter with sacred texts. It is a pathway to spiritual 
			deepening, fostering a sense of connection, wisdom, and transformation. Whether 
			practiced individually or in a communal setting, Lectio Divina offers a timeless 
			and enriching way to engage with the sacred through the written word.<br/><br/>
		</p>

	<div class= "steps">
		<h4>The practice typically involves four stages:</h4>
			<ol>
				<li>
				Lectio (Reading): In this initial stage, a short passage from scripture is read 
				slowly and attentively. The goal is not to analyze or interpret the text 
				intellectually but to absorb the words, allowing them to resonate within.
				</li>
				
				<li>
				Meditatio (Meditation): Following the reading, individuals reflect on the words 
				or phrases that stood out to them. This stage invites a deeper contemplation of 
				the meaning and relevance of the text to one's life.
				</li>
				
				<li>
				Oratio (Prayer): Transitioning from reflection, participants engage in prayerful 
				conversation with the divine. This may involve expressing gratitude, 
				seeking guidance, or simply being present with the feelings and insights that 
				arise during the meditation.
				</li>
				
				<li>
				Contemplatio (Contemplation): The final stage is a silent resting in the presence 
				of the divine. Participants let go of words and thoughts, allowing for a receptive 
				openness to any further insights, inspiration, or a sense of God's presence.
				</li>
			</ol>
		</div>
		
		<div class = verses>
			<h1>Reading from the Psalms</h1>
			<?= $randomVerses ?>
		</div>
		
		<form action="LectioSubmit.php" method="POST">
			<fieldset>
				<legend> Take a moment to reflect... </legend> </br>
						<textarea rows="8" cols="100" name="newLectio" placeholder="Enter your reflections here."></textarea>
				<input type="submit" value="Save" /> </br> 
				
				<!-- Hidden input field to store -->
    			<input type="hidden" name="reflection_type" value="Lectio_Divina">
				
			</fieldset>
		</form>
		<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {?>
			<p class="switch"> Reflection saved! </p>
		<?php } ?>
</div>

<?php
} else {
?>
		<div class= content-container>
			<p>
				It seems you either haven't yet joined our monastery yet or aren't logged in.<br/><br/>
				If you already have an account, 
				<a href="Login.php"><span id="link">Log in.</span></a><br/><br/>
				If you don't have an account, we would love to have you!<br/><br/>
				<a href="Signup.php"><span id="link">Sign up</span></a> to get started!
			</p>
		</div>
<?php
}
?>

<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
