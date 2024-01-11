<?php

function VarExist($var) {
    if (isset($var)) {
        return $var;
    } else {
        header("location:../index.html");
    }
}

$user = new stdClass();

$user->firstName = VarExist($_POST["firstName"]);
$user->lastName = VarExist($_POST["lastName"]);
$user->email = VarExist($_POST["email"]);
$user->username = VarExist($_POST["username"]);
$user->password = VarExist($_POST["password"]);
$user->confirmPassword = VarExist($_POST["confirmPassword"]);
$user->address = VarExist($_POST["address"]);
$user->phone = VarExist($_POST["phone"]);
$user->city = VarExist($_POST["city"]);
$user->country = VarExist($_POST["country"]);
$user->postalCode = VarExist($_POST["postalCode"]);
$user->specialNeeds = isset($_POST["specialNeeds"]) ? true : false;
$user->birthdate = VarExist($_POST["birthdate"]);

InsertUserToDBfromObject($user);

function InsertUserToDBfromObject($user) {
    // Check if passwords match
    if ($user->password !== $user->confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($user->password, PASSWORD_DEFAULT);

    // Calculate the age
    $today = new DateTime();
    $birthdate = new DateTime($user->birthdate);
    $age = $birthdate->diff($today)->y;
    $formattedBirthdate = $birthdate->format('Y-m-d');

    $dbhost = "localhost";
    $dbname = "id20739167_dte";
    $dbuser = "id20739167_root";
    $dbpass = "=U#Wq|Yfvtd2nd>r";
    $db = null;

    try {
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    // Check if specialNeeds is true or false
    $specialNeedsValue = $user->specialNeeds ? 1 : 0;

    // Insert data into the Person table
    $queryPerson = "INSERT INTO Person (name, address, email, phone)
    VALUES ('$user->firstName $user->lastName', '$user->address', '$user->email', '$user->phone')";

    $db->query($queryPerson);

    // Get the last inserted personID
    $personID = $db->lastInsertId();

    // Insert data into the Account table
    $queryAccount = "INSERT INTO Account (personID, password, `User name`)
    VALUES ('$personID', '$hashedPassword', '$user->username')";

    $db->query($queryAccount);

    // Get the last inserted accountID
    $accountID = $db->lastInsertId();

    // Insert data into the Customer table
    $queryCustomer = "INSERT INTO Customer (accountID, FirstName, LastName, DOB, Age, Email, Password, Address, PhoneNumber, City, Country, PostalCode, SpecialNeeds)
    VALUES ('$accountID', '$user->firstName', '$user->lastName', '$formattedBirthdate', '$age', '$user->email', '$hashedPassword', '$user->address', '$user->phone', '$user->city', '$user->country', '$user->postalCode', '$specialNeedsValue')";

    $stmt= $db->query($queryCustomer);

    header("Location: login.php");
    }
    
    function InsertUserToDBfromArray($user){
    print_r($user);
    }
    ?>
