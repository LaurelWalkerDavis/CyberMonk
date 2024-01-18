<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Contemplation page for the CyberMonk website. 
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



/************* GET CONTEMPLATION IMAGES FROM CONTEMPLATION-IMAGES.JSON FILE *************/

$jsonData = file_get_contents('contemplation-images.json');
$contemplationModels = json_decode($jsonData, true);


/************* SELECT A RANDOM CONTEMPLATION IMAGE FROM FILE *************/
$randomIndex = array_rand($contemplationModels);
$randomContemplation = $contemplationModels[$randomIndex];

$fileName = $randomContemplation["fileName"];
$description = $randomContemplation["description"];
$credit = $randomContemplation["credit"];
$imagePath = "contemplation-images/" . $fileName . ".jpeg";

?>


<div class="content-container">
	<h3>Ignatian Contemplation Exercise for <span class="monk"><?= $monk["first_name"] ?>!</span></h3><br/>
		<p class = "exercise-description">
			Ignatian contemplation, also known as imaginative prayer, is a unique and 
			transformative spiritual exercise rooted in the Ignatian tradition, particularly 
			associated with the teachings of St. Ignatius of Loyola. This contemplative practice 
			invites individuals to engage their imagination in a prayerful manner, allowing 
			sacred narratives to come alive in their minds and hearts.<br/><br/>
			Ignatian contemplation is a dynamic and adaptable practice that fosters a 
			personal encounter with the divine. By engaging the imagination, individuals 
			can enter into sacred stories, experiencing them in a way that transcends 
			intellectual understanding. This prayerful exercise is a powerful means of 
			deepening one's relationship with God and gaining fresh perspectives on faith 
			and life.<br/><br/>
		</p>
	<div class= "steps">
		<h4>Ignatian Contemplation typically involves these steps:</h4>
			<ol>
				<li>
					Selecting a Scripture Passage or Scene: Choose a biblical story or scene from 
					the life of Jesus or other figures central to Christian spirituality. 
					This passage becomes the focus of the contemplation.
				</li>
				
				<li>
					Creating a Sacred Space: Find a quiet and comfortable space for prayer. Close 
					your eyes and take a few deep breaths to center yourself. Imagine the details 
					of the chosen scene, creating a mental landscape for your contemplation.
				</li>
				
				<li>
					Engaging the Senses: Enrich the experience by involving your senses. Picture 
					the sights, sounds, smells, and textures of the scene. Immerse yourself in the 
					environment and engage with the characters and elements present.
				</li>
				
				<li>
					Encountering the Divine: As you enter the imaginative space, invite the divine 
					presence into the scene. Allow the characters to interact with you, and be open 
					to receiving insights, messages, or emotions inspired by the narrative.
				</li>
				
				<li>
					Reflecting and Internalizing: After spending time in the contemplative scene, 
					reflect on your experience. Consider how the encounter has touched you spiritually, 
					emotionally, or intellectually. Take note of any insights, emotions, or resolutions 
					that arise.
				</li>
				
				<li>
					Praying with the Heart: Conclude the exercise with a heartfelt prayer. Express 
					gratitude for the insights gained, seek guidance, or offer intentions for yourself 
					and others.
				</li>
			</ol>

		<div class = contemplation>
            <h1><?= $description ?></h1></br>
            <img src="<?= $imagePath ?>" alt="<?= $description ?>";"></br>
            <p class = "switch"><?= $credit ?></p>
        </div>
		
		<form action="ContemplationSubmit.php" method="POST">
			<fieldset>
				<legend> Take a moment to reflect... </legend> </br>
						<textarea rows="8" cols="100" name="newContemplation" placeholder="Enter your reflections here."></textarea>
				<input type="submit" value="Save" /> </br> 
				
				<!-- Hidden input field to store -->
    			<input type="hidden" name="reflection_type" value="Contemplation">
				
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
