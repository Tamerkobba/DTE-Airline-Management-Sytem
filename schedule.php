<?php
session_start();
if (!isset($_SESSION['email_or_username'])) {
  // Handle the error case here
  echo "Session not set";
  exit;}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="../css/style.css">


<link rel="icon" href="../images/fevicon.png" type="image/gif" />

<title>Schedule</title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<title>Upcoming Flights</title>
    <style>
       body {
        background-color: #6b52ae;
        font-family: Arial, sans-serif;
        color: white;
      }
      h1 {
        text-align: center;
        font-size: 48px;
        margin-top: 50px;
      }
      table {
        margin: auto;
        border-collapse: collapse;
        border: 2px solid white;
      }
      th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid white;
      }
      th {
        background-color: #8a5de8;
      }
      td {
        background-color: #a28feb;
      }
      .adjust-button {
        background-color: #fff;
        color: #6b52ae;
        padding: 8px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
      }
      .form-popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
      }
      .form-container {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 10px;
        width: 300px;
        padding: 20px;
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
      .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
      }
      .form-container label {
        margin-bottom: 10px;
      }
      .form-container select {
        margin-bottom: 20px;
        padding: 5px;
        border-radius: 5px;
        border: none;
      }
      .form-container button {
        background-color: #6b52ae;
        color: #fff;
        padding: 8px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
      .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        font-weight: bold;
        color: #000;
        cursor: pointer;
      }
      img{
        width: 300px;
        display: block;
	margin-left: auto;
	margin-right: auto;
  border-radius: 20px;
      }
    </style>
</head>
<body>
  <div class="header_section">
		
    <nav class="snip1143">
      <ul>
        <li><a href="index.php" data-hover="Home">Home</a></li>
        <li><a href="Booking.html" data-hover="Booking">Book A Flight</a></li>
        <li><a href="Loyalty.html" data-hover="Loyalty Program">Loyalty Program</a></li>
      </ul>
      </nav>
  </div>
</div>
<h1 style="color: white; text-transform: uppercase;font:oblique;">Upcoming Flights</h1>
  <table>
    <thead>
      <tr>
        <th>Flight Number</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Date</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
   
    <?php
// Database connection parameters
$dbhost = "localhost";
$dbname = "id20739167_dte";
$dbuser = "id20739167_root";
$dbpass = "=U#Wq|Yfvtd2nd>r";

try {
    // Connect to the database
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the email or username from the session
    $email_or_username = $_SESSION['email_or_username'];

    // Prepare the SQL statement to get the customerID for this user
    $stmt = $db->prepare("SELECT CustomerID FROM Customer INNER JOIN Account ON Customer.accountID = Account.accountID INNER JOIN Person ON Account.personID = Person.personID WHERE Account.`User name` = :email_or_username OR Person.email = :email_or_username");
    $stmt->bindParam(':email_or_username', $email_or_username, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the customerID
    $customerID = $stmt->fetchColumn();

    if ($customerID === false) {
        throw new Exception('No customerID found for this user');
    }
// Prepare the SQL statement to get the flight reservations for this customer
$stmt = $db->prepare("SELECT Flightreservation.*, Flight.*, depart_airport.name as departure_airport_name, depart_airport.address as departure_airport_address, arrival_airport.name as arrival_airport_name, arrival_airport.address as arrival_airport_address FROM Flightreservation INNER JOIN Flight ON Flight.flightID = Flightreservation.flightID INNER JOIN Airport as depart_airport ON Flight.departureAirportID = depart_airport.airportID INNER JOIN Airport as arrival_airport ON Flight.arrivalAirportID = arrival_airport.airportID WHERE Flightreservation.CustomerID = :customerID");
$stmt->bindParam(':customerID', $customerID, PDO::PARAM_INT);
$stmt->execute();

// Fetch all the flight reservations
$flightReservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through the flight reservations and output the table rows
foreach ($flightReservations as $flightReservation) {
  echo "<tr>";
  echo "<td>{$flightReservation['flightID']}</td>";
  echo "<td>{$flightReservation['departure_airport_name']} ({$flightReservation['departure_airport_address']})</td>";
  echo "<td>{$flightReservation['arrival_airport_name']} ({$flightReservation['arrival_airport_address']})</td>";
  echo "<td>{$flightReservation['reservation']}</td>";
  echo "<td><button class='adjust-button' onclick=\"openForm('form2', {$flightReservation['flightID']})\">Adjust Flight Details</button></td>";
  echo "</tr>";
}
} catch (PDOException $e) {
    // Display an error message if there's an issue with the database connection
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    // Display an error message if no customerID found
    echo "Error: " . $e->getMessage();
}
?>
</body>
</html>
  <script>
		function openForm(formId, flightId) {
    // Create the form and add it to the page
    var form = document.createElement("div");
    form.setAttribute("id", formId + flightId);
    form.setAttribute("class", "form-popup");
    var html = '<form id="adjust-form" class="form-container" onsubmit="submitForm(event, \'' + formId + flightId + '\', ' + flightId + ')">';
    html += '<span class="close" onclick="closeForm(\'' + formId + flightId + '\')">&times;</span>';
    html += '<h2>Adjust Flight Details for Flight ' + flightId + '</h2>';
    html += '<label for="meal">Meal:</label>';
    html += '<select id="meal" name="meal"><option value="Vegetarian">Vegetarian</option><option value="Gluten-free">Gluten-free</option><option value="Kosher">Kosher</option><option value="Standard">Standard</option></select>';
    html += '<button type="submit">Save Changes</button>';
    html += '</form>';
    form.innerHTML = html;
    document.body.appendChild(form);

    // Display the form
    document.getElementById(formId + flightId).style.display = "block";
}
function closeForm(formId) {
    // Get the form popup element by id
    var formPopup = document.getElementById(formId);

    // Hide the form popup
    if (formPopup) {
        formPopup.style.display = "none";

        // Remove the form from the DOM
        formPopup.remove();
    }
}

function submitForm(event, formId, flightId) {
    event.preventDefault();

    var form = document.getElementById("adjust-form");
    var formData = new FormData(form);

    fetch("adjust_flight.php", {
        method: "POST",
        body: formData
    }).then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    }).then(data => {
        alert("Flight details updated successfully!");
        closeForm(formId);
    }).catch(error => {
        console.error("Error:", error);
    });
}


	  </script>
   
</body>
<br><br>
	<img src="../images/dora.png">
</html>