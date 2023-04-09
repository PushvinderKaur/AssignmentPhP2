<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
</head>
<body>
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to the website page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
   exit;
}
include 'conn.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM signup WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to index page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    /* Add some CSS styles to the form elements */
    *{
        background: darkslategray;
    }
    input[type=text], input[type=password] {
      width: 40%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    input[type=submit]{
        color: white;
        height: 40px;
    }
    input[type=submit]:hover{
        color: red;
        width: 100px;
    }
    .container {
        margin-left: 30%;
        width: 40%;
        height: 70%;
        margin-top: 200px;
        text-align: center;
        color: white;
        border: 4px solid orange;
        border-radius: 20px; 
    }
    span.psw {
      float: right;
    }
    /* Add some CSS styles to display error messages */
    .error {
      color: red;
      font-size: 14px;
      margin-top: 10px;
    }
    label{
        margin: 20px 12px;
        font-size: 20px;
    }
    label a{
        color: red;
        decoration: none;
    }
  </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>"><br>
            <span><?php echo $username_err; ?></span><br>
            <label>Password:</label>
            <input type="password" name="password"><br>
            <span><?php echo $password_err; ?></span><br>
            <input type="submit" value="Login">
        </form>
        <label>Don't have account. Click <a href="SignUp.php">Signup </a>to create one.
        </label>
    </div>
</body>
</html>


