<?php 
session_start();

$display_name = '';
$colorClass = 'bronze'; // default color

if (isset($_SESSION['email_or_username'])) {
    $dbhost = "localhost";
    $dbname = "id20739167_dte";
    $dbuser = "id20739167_root";
    $dbpass = "=U#Wq|Yfvtd2nd>r";

    // Establish a new PDO connection
    try {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Could not connect to the database: " . $e->getMessage());
    }
    $display_name = $_SESSION['email_or_username'];
    if (strpos($display_name, '@') !== false) { // if it contains '@', it's an email
        $display_name = explode('@', $display_name)[0];
        $stmt = $pdo->prepare("SELECT Points FROM Customer WHERE Email = :email_or_username");
    } else { // else, it's a username
        $stmt = $pdo->prepare("SELECT Points FROM Customer INNER JOIN Account ON Customer.accountID = Account.accountID WHERE Account.`User name` = :email_or_username");
    }
    
    $stmt->execute([':email_or_username' => $_SESSION['email_or_username']]);
    $points = (int)$stmt->fetchColumn();

    if ($points > 500) {
        $colorClass = 'gold';
    } elseif ($points > 300) {
        $colorClass = 'silver';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<style>
	   .bronze {
        color: #cd7f32 !important;
    }
    .silver {
        color: #c0c0c0 !important;
    }
    .gold {
        color: #ffd700 !important;
    }
	</style>
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
				<ul><?php if (isset($_SESSION['email_or_username'])): ?>
    <li><a href="logged.php" data-hover="Home">Home</a></li>
    <li><a href="schedule.php" data-hover="Schedule">Schedule</a></li>
    <li><a href="Booking.html" data-hover="Booking">Book A Flight</a></li>
    <li><a href="Loyalty.html" data-hover="Loyalty Program">Loyalty Program</a></li>
    <li>
        <a href="logout.php" data-hover="Log out" class="<?php echo $colorClass; ?>"><?php echo $display_name; ?></a>
    </li>
<?php else: ?>
    <li><a href="index.php" data-hover="Home">Home</a></li>
    <li><a href="login.php" data-hover="Schedule">Schedule</a></li>
    <li><a href="login.php" data-hover="Booking">Book A Flight</a></li>
    <li><a href="Loyalty.html" data-hover="Loyalty Program">Loyalty Program</a></li>
    <li><a href="login.php" data-hover="LOGIN/REGISTER">LOGIN/REGISTER</a></li>
<?php endif; ?>

                  </li>
				</ul>
			  </nav>
		</div>
	</div>
	
	<div class="banner_section layout_padding">
	  <div class="container">
		<h1 class="banner_taital">SkyTrack</h1>
		<h2 class="free_text">Your high-flying travel companion. Safe, comfortable, and efficient air travel, from takeoff to landing </h2>
			  <div class="read_bt">
				<div class="read_text"><a href="ReadMore.html">Read More</a></div>
			  </div>
	  </div>
    
	</div>
</body>

</html>
