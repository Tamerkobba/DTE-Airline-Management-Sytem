<?php
session_start();
if (isset($_SESSION['warning'])) {
    echo "<div class='warning'>" . $_SESSION['warning'] . "</div>";
    unset($_SESSION['warning']);
}
?>

<?php


$dbhost = "localhost";
$dbname = "id20739167_dte";
$dbuser = "id20739167_root";
$dbpass = "=U#Wq|Yfvtd2nd>r";

$specialNeeds = "";

if (isset($_SESSION['email_or_username'])) {
    $username_or_email = $_SESSION['email_or_username'];

    try {
        // Connect to the database
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to retrieve accountID by username or email
        $stmt = $db->prepare("SELECT Account.accountID FROM Account INNER JOIN Person ON Account.personID = Person.personID WHERE Account.`User name` = :username_or_email OR Person.email = :username_or_email");
        $stmt->bindParam(':username_or_email', $username_or_email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $account = $stmt->fetch(PDO::FETCH_ASSOC);
            $accountID = $account['accountID'];

            // Prepare the SQL statement to retrieve SpecialNeeds by accountID
            $stmt = $db->prepare("SELECT Customer.SpecialNeeds FROM Customer WHERE Customer.accountID = :accountID");
            $stmt->bindParam(':accountID', $accountID, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $customer = $stmt->fetch(PDO::FETCH_ASSOC);
                $specialNeeds = $customer['SpecialNeeds'];
            }
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <title>PreferencePage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Flights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9370DB;
            color: #fff;
        }

        header {
            text-align: center;
            padding: 40px;
        }

        h1 {
            font-size: 36px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
		.modal {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #a89bfe;
        margin: 15% auto;
        padding: 20px;
        border-radius: 5px;
        border: 1px solid #888;
        width: 50%;
        color: #fff;
    }

    .close {
        color: #fff;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #ccc;
        text-decoration: none;
        cursor: pointer;
    }

    label {
        font-size: 18px;
        margin-right: 10px;
    }

    select {
        font-size: 16px;
        margin-bottom: 20px;
    }

    input[type="submit"] {
        font-size: 18px;
        padding: 8px 16px;
        background-color: #9370DB;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #7B68EE;
    }
 </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="logo"><a href="logged.php"><img src="../images/downloadq.png"></a></div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </div>
    <header>
        <div>
            <div class="modal-content">
                <h2>Passenger Preferences</h2>
                <form action="res.php" method="post">
                    <label for="meal">Meal type:</label>
                    <select name="meal" id="meal">
                        <option value="standard">Standard</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="vegan">Vegan</option>
                    </select>
                    <br><br>
                    <label for="seat">Seat type:</label>
                    <select name="seat" id="seat">
                        <option value="economy">Economy</option>
                        <option value="premium-economy">Premium Economy</option>
                        <option value="business">Business</option>
                        <option value="First Class">First Class</option>
                    </select>
                    <br><br>
                  <label for="accommodation">Accommodation:</label>
                    <select name="accommodation" id="accommodation">
                        <?php if ($specialNeeds == 1): ?>
                            <option value="Wheel Chair Seat">Wheel Chair Seat</option>
                            <option value="Pregnant Seat">Pregnant Seat</option>
                        <?php else: ?>
                            <option value="none" selected>None</option>
                        <?php endif; ?>
                    </select>
                    <br><br>
                    <input type="hidden" name="flightID" id="flightID" value="">

                    <input type="submit" value="Book Now!">
                </form>
            </div>
        </div>
    </header>
    <script>
        function getFlightIDFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('flightID');
        }

        const flightID = getFlightIDFromURL();
        document.getElementById("flightID").value = flightID;

        var modal = document.getElementById("myModal");
        var header = document.querySelector("header");
        var span = document.getElementsByClassName("close")[0];

        header.addEventListener("click", function() {
            modal.style.display = "block";
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>