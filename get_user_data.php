<?php
session_start();
header('Content-Type: application/json');

// Database connection parameters
$dbhost = "127.0.0.1";
$dbname = "dte";
$dbuser = "root";
$dbpass = "=U#Wq|Yfvtd2nd>r";

if (isset($_POST['email_or_username'])) {
    $accountID = $_POST['email_or_username'];

    try {
        // Connect to the database
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to retrieve account information by username or email
        $stmt = $db->prepare("SELECT Customer.SpecialNeeds FROM Customer INNER JOIN Account ON Customer.accountID = Account.accountID WHERE Account.`User name` = :accountID");
        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $account = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($account);
        } else {
            echo json_encode(array("error" => "Invalid accountID"));
        }

    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
}
?>
