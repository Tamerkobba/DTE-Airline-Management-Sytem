<?php
function VarExist($var) {
    if (isset($var)) {
        return $var;
    } else {
        header("Location: ../admin.html");
    }
}

$flightID = VarExist($_POST["flight_id"]);

deleteFlightFromDB($flightID);

function deleteFlightFromDB($flightID) {
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

    $query = "DELETE FROM Flight WHERE flightID = :flightID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':flightID', $flightID, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: admin.html");
}
?>
