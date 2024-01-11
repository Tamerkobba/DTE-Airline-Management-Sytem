<?php
function VarExist($var) {
    if (isset($var)) {
        return $var;
    } else {
        header("location:../admin.html");
    }
}

$user = new stdClass();

$user->firstName = VarExist($_POST["firstName"]);
$user->lastName = VarExist($_POST["lastName"]);
$user->email = VarExist($_POST["email"]);
$user->username = VarExist($_POST["username"]);
$user->password = VarExist($_POST["password"]);
$user->address = VarExist($_POST["address"]);
$user->phone = VarExist($_POST["phone"]);
$user->city = VarExist($_POST["city"]);
$user->country = VarExist($_POST["country"]);
$user->postalCode = VarExist($_POST["postalCode"]);
$user->birthdate = VarExist($_POST["birthdate"]);
$user->level = VarExist($_POST["level"]);

InsertUserToDBfromObject($user);

function InsertUserToDBfromObject($user) {
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
    try {
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    $queryPerson = "INSERT INTO Person (name, address, email, phone)
    VALUES ('$user->firstName $user->lastName', '$user->address', '$user->email', '$user->phone')";

    $db->query($queryPerson);

   
    $personID = $db->lastInsertId();

    $queryAccount = "INSERT INTO Account (personID, password, status, level)
    VALUES ('$personID', '$hashedPassword', 'active', '$user->level')";

    $db->query($queryAccount);

   
    $accountID = $db->lastInsertId();

    header("Location: admin.html");
}
?>
