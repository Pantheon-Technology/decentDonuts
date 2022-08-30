<!DOCTYPE html>
<html>
<head>
<title>Decent Donuts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" href="decentDonuts.css">
<link rel="icon" href="Pictures/Logo.jpg">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
</style>
</head>
<body class="brown">
<?php
// starts a session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT adminID FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters to be bound
            $param_username = trim($_POST["username"]);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store the result of the excuting statement
                mysqli_stmt_store_result($stmt);
                // checks if the username already exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken. Please try another";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement, inserts the information into the adminaccount table in the database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters to be bound
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to HOME page once account has been created
                header("location: adminLogin.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!-- ADMIN Navbar (sit on top) -->

<!-- Main class -->
<div class="w3-container w3-padding-64 brown w3-xlarge">
  <div class="w3-content">
  <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Decent Donuts</h1>
    <h2 class="w3-center w3-text-white" style="margin-bottom:64px">Admin Creation Form</h2>
    <p>Please Enter a username and Password to create a new admin.</p>
    <!-- Input form to add admin to the database -->
    <form action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>" method="post">
        <!-- input box for username -->
      <p><input class="w3-input w3-padding-16 w3-border" type="text" auto_complete="no" placeholder="username" required name="username"></p>
      <?php
        // display appropriate error message
                echo (! empty($username_err)) ? 'is-invalid' : '';
                ?>
                <span class="invalid-feedback"><?php

                echo $username_err;
                ?></span>

        <!-- Input box for password -->
      <p><input class="w3-input w3-padding-16 w3-border" type="password" auto_complete="no" placeholder="Password" required name="password"></p>
      <?php
        // display appropriate error message
                echo (! empty($password_err)) ? 'is-invalid' : '';
                ?>
                <span class="invalid-feedback"><?php

                echo $password_err;
                ?></span>
        <!-- Input box for password -->
      <p><input class="w3-input w3-padding-16 w3-border" type="password" auto_complete="no" placeholder="Re-enter Password" required name="confirm_password"></p>
      <?php
      // display appropriate error message
      echo (! empty($confirm_password_err)) ? 'is-invalid' : '';
                ?>
                <span class="invalid-feedback"><?php

                echo $confirm_password_err;
                ?></span>
        <!-- Create data or reset form -->
      <p><button class="w3-button w3-light-grey w3-block" type="submit">Create</button></p>
      <p><button class="w3-button w3-light-grey w3-block" type="reset">Reset data</button></p>
    </form>

  </div>
</div>

</body>
</html>