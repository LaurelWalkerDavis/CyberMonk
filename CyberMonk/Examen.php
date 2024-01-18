<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Examen page for the CyberMonk website. 
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
?>


<div class="content-container">
	<h3>Examen Exercise for <span class="monk"><?= $monk["first_name"] ?>!</span></h3><br/>
		<p class = "exercise-description">
			The Examen, a spiritual practice rooted in the Ignatian tradition, is a reflective 
			and contemplative prayer that invites individuals to review their day, recognize 
			the presence of the divine, and discern the movements of the spirit within their lives. 
			Developed by St. Ignatius of Loyola, the founder of the Jesuit order, the Examen is 
			a flexible and adaptable practice that can be incorporated into daily life.<br/><br/>
			The Examen is a powerful tool for cultivating mindfulness, fostering gratitude, 
			and deepening one's relationship with the divine. Whether practiced in the 
			evening as a review of the day or adapted for specific situations, the Examen 
			provides a framework for spiritual reflection and growth. It encourages individuals 
			to discern the presence of God in the midst of everyday life and to respond with 
			openness and gratitude.<br/><br/>
		</p>

	<div class= "steps">
		<h4>The Examen typically involves five key steps:</h4>
			<ol>
				<li>
					Gratitude: Begin by expressing gratitude for the gifts, moments, and experiences 
					of the day. Recognize the blessings, both big and small, that have unfolded in your life.
				</li>
				
				<li>
					Review: Reflect on the events of the day with a spirit of awareness. Consider 
					the highs and lows, moments of joy or sorrow, and interactions with others. 
					Pay attention to the emotions and feelings associated with these experiences.
				</li>
				
				<li>
					Desolations: Acknowledge any shortcomings, mistakes, or instances 
					where you may have fallen short of your ideals. Offer a prayer of contrition, 
					expressing sorrow, seeking forgiveness, and expressing a desire for growth.
				</li>
				
				<li>
					Consolations: Identify moments when you felt a sense of connection, inspiration, or a 
					deeper awareness of the Christ with you. Recognize the grace that has been present in 
					your day, and allow these moments to inform your spiritual journey.
				</li>
				
				<li>
					Renewal: Look ahead to the coming day or days with a sense of purpose and commitment. 
					Invite the divine into your future experiences, seeking guidance and strength to 
					live with greater intention and alignment with your values.
				</li>
			</ol>
		
		<form action="ExamenSubmit.php" method="POST">
			<fieldset>
				<legend> Take a moment to reflect... </legend> </br>
						<textarea rows="8" cols="100" name="newConsolation" placeholder="Enter your consolations here."></textarea>
						<textarea rows="8" cols="100" name="newDesolation" placeholder="Enter your desolations here."></textarea>
				<input type="submit" value="Save" /> </br> 
				
				<!-- Hidden input field to store -->
    			<input type="hidden" name="reflection_type" value="Examen">
				
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
