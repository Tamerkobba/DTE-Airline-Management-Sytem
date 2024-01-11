<?php
session_start();
if (isset($_SESSION['email_or_username'])) {
    header("Location: logged.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="../css/style.css">


<link rel="icon" href="../images/fevicon.png" type="image/gif" />

<title>HomePage</title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>
<body>
	<div class="header_section">
		
			<nav class="snip1143">
				<ul>
				  <li><a href="index.php" data-hover="Home">Home</a></li>
				  <li><a href="login.php" data-hover="Schedule">Schedule</a></li>
				  <li><a href="login.php" data-hover="Booking">Book A Flight</a></li>
				  <li><a href="Loyalty.html" data-hover="Loyalty Program">Loyalty Program</a></li>
				  <li><a href="login.php" data-hover="LOGIN/REGISTER">LOGIN/REGISTER</a></li>
				</ul>
			  </nav>
		</div>
	</div>
	
	<div class="banner_section layout_padding">
	  <div class="container">
		<h1 class="banner_taital">SkyTrack</h1>
		<h2 class="free_text">Your high-flying travel companion. Safe, comfortable, and efficient air travel, from take off to landing. </h2>
			  <div class="read_bt">
				<div class="read_text"><a href="ReadMore.html">Read More</a></div>
			  </div>
	  </div>
    
	</div>

	


</body>

</html>