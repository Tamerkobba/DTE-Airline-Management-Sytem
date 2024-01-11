<?php
// search_flights.php

// Database connection
$dbhost = "localhost";
$dbname = "id20739167_dte";
$dbuser = "id20739167_root";
$dbpass = "=U#Wq|Yfvtd2nd>r";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$from = $_POST['from'];
$to = $_POST['to'];
$departure = $_POST['departure'];
$return = $_POST['return'];

$sql = "SELECT f.flightID, a1.name as origin, a2.name as destination, f.departureTime, f.returnTime
        FROM Flight f
        JOIN Airport a1 ON f.departureAirportID = a1.airportID
        JOIN Airport a2 ON f.arrivalAirportID = a2.airportID
        WHERE a1.name = ? AND a2.name = ? AND DATE(f.departureTime) = ? AND DATE(f.returnTime) = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $from, $to, $departure, $return);
$stmt->execute();

$result = $stmt->get_result();
$flights = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

// Store the flights in a session variable
session_start();
$_SESSION['flights'] = $flights;

// Redirect to the HTML page
header("Location: pick.php");
exit();
?>
