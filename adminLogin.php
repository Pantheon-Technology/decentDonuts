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
<?php 
session_start();
include_once "config.php"; 

$username = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
    $$error = "Please enter your Username";
  }else{
    $username = trim($_POST["username"]);
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
    $error = "Please enter your password";
  }else{
    $password = trim($_POST["password"]);
  }

  if(empty($error)){
    $sql = "SELECT adminID, username, password FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = $username;

        if (mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {
                    // the password matches the username, start a new session
                    session_start();

                    // Store data about the current session in variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["UserID"] = $id;
                    $_SESSION["username"] = $username;

                    // Redirect user to my main web page
                    header("location: adminHome.php");
                } else {
                    // Password is not valid, display a generic error message
                    $error = "Invalid password.";
                }
            }
        } else {
            // Username doesn't exist, display a generic error message
            $error = "Invalid username";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
}
  }

// Close connection
mysqli_close($conn);
}
?>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body class="brown">
<!-- !PAGE CONTENT! -->

<div class="w3-main">

  <!-- Header -->
    <h1 class ="w3-animate-top w3-center"><b>DECENT DONUTS - Admin Login</b></h1>

    <div class="w3-main w3-content w3-padding w3-animate-right" style="max-width:1200px;margin-top:70px">
  <div class="w3-row-padding w3-padding-16 w3-center pink w3-round w3-margin-top">
    <h3>Admin Login Form</h3>
    <form action = "<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input class="w3-input w3-center w3-margin-bottom" placeholder="Username" input type="text" required name ="username">
    <input class="w3-input w3-center w3-margin-bottom"  placeholder="Password" input type="password" required name="password">
    <button class="w3-button w3-black w3-margin-bottom" input type="submit" value="login">Submit Login</button>
    </form>
    <p><?php echo $error; ?></p>
  </div>

  <!-- End page content -->
</div>
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<script src ="index.js"></script>

</body>
</html>