<!-----------------------------------
AUTHOR
Laurel Walker Davis
CPSC 5200
Fall Term B - 2023
Module 7: Final Project

DESCRIPTION
This php file is the navigation bar for the CyberMonk website. 
It uses "Design.css" for formatting.

ASSOCIATED FILES
Design.css			Login.php
Header.html			Account.php
Footer.html			LectioDivina.php
Navigation.php		Examen.php
index.php			Contemplation.php
Signup.php			LifeReview.php
------------------------------------->
<?php session_start(); ?>

<!------------SESSION----------------->


<div class="topnav">
  <a href="index.php" class="active">Home</a>
  <a href="LectioDivina.php">LectioDivina</a>
  <a href="Examen.php">Examen</a>
  <a href="Contemplation.php">Contemplation</a>
  <a href="LifeReview.php">Life Review</a>
  <div class="dropdown">
    <button class="dropbtn">
    <a href="Account.php">Account</a> 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="Login.php">Login</a>
      <a href="Logout.php">Log out</a>
    </div>
  </div> 
</div>