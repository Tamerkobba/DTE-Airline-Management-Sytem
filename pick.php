<?php
        session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
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

.container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
}

.flight-card {
    background-color: #6A5ACD;
    padding: 20px;
    border-radius: 5px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.flight-card:hover {
    cursor: pointer;
}

.flight-card a {
    text-decoration: none;
    color: inherit;
}

.flight-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.flight-card p {
    font-size: 16px;
    margin-bottom: 10px;
}

.modal {
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
</head>
<body>
    <header>
        <h1>Available Flights</h1>
        <h2>Based on your preferences</h2>
    </header>
    <div class="container">
    <?php
        if (isset($_SESSION['flights'])) {
            $flights = $_SESSION['flights'];
            unset($_SESSION['flights']); // Clear the session variable
            foreach ($flights as $flight) {
                echo '<div class="flight-card">';
                echo '<a href="pref.php?flightID=' . $flight['flightID'] . '">';
                echo '<h3>Flight ' . $flight['flightID'] . '</h3>';
                echo '<p>Departure: ' . $flight['origin'] . ' - ' . $flight['departureTime'] . '</p>';
                echo '<p>Arrival: ' . $flight['destination'] . ' - ' . $flight['returnTime'] . '</p>';
                echo '</a>';
                echo '</div>';
            }
        }
        ?>
    </div>
    
</body>
</html>





