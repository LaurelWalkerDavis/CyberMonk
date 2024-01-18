<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Login page for the CyberMonk website. 
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

		<form action="Landing.php" method="POST">
			<fieldset>
				<legend> Log in to access your notes! </legend> </br>
			
				<label class = "label" for="email"> Email address: </label> 
				<input type="email" size="16" name="email"/> </br>
				<label class = "label" for="password"> Password: </label> 
				<input type="text" size="16" name="password" /> </br>
				
				<input type="submit" value="Log in" /> </br> 
				
				<a class= "switch" href="Signup.php">New here? Join now!</a>
			</fieldset>
		</form>



<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
