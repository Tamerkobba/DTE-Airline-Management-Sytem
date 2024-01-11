<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email_or_username']) && isset($_SESSION['level'])) {
    // Check account level and redirect accordingly
    if ($_SESSION['level'] === 'Admin') {
        header("Location: admin.html");
    } elseif ($_SESSION['level'] === 'Customer') {
        header("Location: logged.php");
    } else {
        // Redirect back to the login page with an error message
        header("Location: login.html?error=Invalid account level");
    }
    exit;
}

if (isset($_POST['email_or_username']) && isset($_POST['password'])) {
    // Retrieve the submitted accountID and password from the form
    $accountID = $_POST['email_or_username'];
    $password = $_POST['password'];

    // Database connection parameters
    $dbhost = "localhost";
    $dbname = "id20739167_dte";
    $dbuser = "id20739167_root";
    $dbpass = "=U#Wq|Yfvtd2nd>r";

    try {
        // Connect to the database
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to retrieve account information by username or email
        $stmt = $db->prepare("SELECT Account.*, Person.email FROM Account INNER JOIN Person ON Account.personID = Person.personID WHERE Account.`User name` = :accountID OR Person.email = :accountID");
        $stmt->bindParam(':accountID', $accountID, PDO::PARAM_STR);
        $stmt->execute();

        // Check if the account is found
        if ($stmt->rowCount() > 0) {
            // Fetch account information
            $account = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the entered password against the password in the database
           // ...
if (password_verify($password, $account['password'])) {
    // Check account level and redirect accordingly
    if ($account['level'] === 'Admin') {
        header("Location: admin.html");
    } elseif ($account['level'] === 'Customer') {
        // Set session variables only for customers
        $_SESSION['email_or_username'] = $accountID;
        $_SESSION['level'] = $account['level'];
        header("Location: logged.php");
    } else {
        // Redirect back to the login page with an error message
        header("Location: login.html?error=Invalid account level");
    }
} else {
    // Redirect back to the login page with an error message
    header("Location: login.html?error=Invalid password");
}
        }


    } catch (PDOException $e) {
        // Display an error message if there's an issue with the database connection
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
  <link rel="stylesheet" href="../css/log.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body style="background-image: url(../images/airplane-pastel-purple-background-3d-render_576429-695.png)">
	<div class="header_section">
		
    <nav class="snip1143">
      <ul>
        <li><a href="index.php" data-hover="Home">Home</a></li>
        <li><a href="Loyalty.html" data-hover="Loyalty Program">Loyalty Program</a></li>
     
      </ul>
      </nav>
  </div>
</div>
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" action="login.php" method="POST">
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" class="login__input" name="email_or_username" placeholder="Email/Username" value="<?php echo isset($_COOKIE['email_or_username']) ? $_COOKIE['email_or_username'] : ''; ?>" required>
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="login__input" name="password" placeholder="Password" required>
                </div>
        


                    <button type="submit" class="button login__submit">
                        <span class="button__text">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <br>

                    <p style="color: rgb(1, 27, 49);">Don't have an account? then</p>
                    <a class="button Signin__submit" href="Sign.html">
                        <span class="button__text_signin">SignUp Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </a>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>      
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>      
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

























