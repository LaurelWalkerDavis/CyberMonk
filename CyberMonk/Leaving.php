<!----------------------------------------------------------------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the Leaving page for the CyberMonk website. 
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

		<div class= content-container>
			<p id="benediction">
				May the peace of Christ go with you<br/><br/>
				Wherever He may send you<br/><br/>
				May He guide you through the wilderness<br/><br/>
				Protect you through the storm<br/><br/>
				May He bring you home rejoicing<br/><br/>
				At the wonders He has shown you<br/><br/>
				May He bring you home rejoicing<br/><br/>
				Once again into our doors<br/><br/><br/>
				<a href="Login.php"><span id="link">Log in</span></a> to come home!
			</p>

		</div>



<!------------FOOTER----------------->
<?php include("Footer.html"); ?>
<?php include("BackBar.html"); ?>
