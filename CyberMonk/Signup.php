<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Signup page for the CyberMonk website. 
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

<?php session_unset(); ?>
<?php session_destroy(); ?>
<!------------HEADER----------------->

		<form action="Welcome.php" method="POST">
			<fieldset>
				<legend> Create an account with CyberMonk! </legend> </br>
			
				<label class = "label"> First Name: </label> 
				<input type="text" size="16" name="first_name"/> </br>
				<label class = "label"> Last Name: </label> 
				<input type="text" size="16" name="last_name"/> </br>
				<label class = "label"> Email address: </label> 
				<input type="email" size="16" name="email"/> </br>
				<label class = "label"> Password: </label> 
				<input type="text" size="16" name="password" /> </br>
				<label class = "label"> Password Confirmation: </label> 
				<input type="text" size="16" name="passwordConf"/>  </br></br>
				
				<!-- Hidden input field to store the current date, lectio, examen, and contemplation -->
    			<input type="hidden" name="signup_date" value="<?php echo date('m-d-Y'); ?>">
								
				<input type="submit" value="Create Account" /> </br> 
				
				<a class= "switch" href="Login.php">Already have an account?</a>
			</fieldset>
		</form>


<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>


