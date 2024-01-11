<?php
function VarExist($var) {
    if (isset($var)) {
        return $var;
    } else {
        header("Location: ../admin.html");
    }
}

$departureAirport = VarExist($_POST["departure"]);
$arrivalAirport = VarExist($_POST["destination"]);
$departureDate = VarExist($_POST["DepartureDate"]);
$returnDate = VarExist($_POST["ReturnDate"]);
$gate = VarExist($_POST["Gate"]);
$aircraft = VarExist($_POST["aircraft"]);
$price = VarExist($_POST["price"]);

createFlight($departureAirport, $arrivalAirport, $departureDate, $returnDate, $gate, $aircraft, $price);


function createFlight($departureAirport, $arrivalAirport, $departureDate, $returnDate, $gate, $aircraft, $price) {
    $dbhost = "localhost";
    $dbname = "id20739167_dte";
    $dbuser = "id20739167_root";
    $dbpass = "=U#Wq|Yfvtd2nd>r";
    try {
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    // Check if departure and arrival airports exist in the Airport table and are not the same
    $query = "SELECT airportID, name FROM Airport WHERE name = :departureAirport OR name = :arrivalAirport";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':departureAirport', $departureAirport);
    $stmt->bindParam(':arrivalAirport', $arrivalAirport);
    $stmt->execute();
    $airports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($airports) == 2 && $airports[0]['name'] != $airports[1]['name']) {
        $departureAirportID = $airports[0]['airportID'];
        $arrivalAirportID = $airports[1]['airportID'];

        // Insert flight data into the Flight table
        $queryFlight = "INSERT INTO Flight (departureAirportID, arrivalAirportID, departureTime, returnTime, gate, aircraftID, price)
    VALUES (:departureAirportID, :arrivalAirportID, :departureDate, :returnDate, :gate, :aircraft, :price)";
        $stmt = $db->prepare($queryFlight);
        $stmt->bindParam(':departureAirportID', $departureAirportID, PDO::PARAM_INT);
        $stmt->bindParam(':arrivalAirportID', $arrivalAirportID, PDO::PARAM_INT);
        $stmt->bindParam(':departureDate', $departureDate);
        $stmt->bindParam(':returnDate', $returnDate);
        $stmt->bindParam(':gate', $gate);
        $stmt->bindParam(':aircraft', $aircraft, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: admin.html");
    } else {
        // Handle error: airports do not exist or are the same
        echo "Error: Departure and arrival airports must exist in the Airport table and must not be the same.";
    }
}
?>
