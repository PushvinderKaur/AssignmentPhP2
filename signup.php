<?php
include 'conn.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

// Check password complexity
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    $message = 'Password should be at least 8 characters in length and should include at least one uppercase letter, one lowercase letter, one number, and one special character.';
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Check if email is already registered
  $query = "SELECT * FROM signup WHERE email = '$email'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $message = 'Email already registered Try to login';
  } else {
    // Insert new user into database
    $query = "INSERT INTO signup (first_name, last_name, username, email, password) VALUES ('$first_name', '$last_name', '$username', '$email', '$hashed_password')";
    if ($conn->query($query) === TRUE) {
      $_SESSION['username'] = $conn->insert_id;
      session_start(); // Start the session

        $_SESSION['username'] = mysqli_insert_id($conn);
      header("location: login.php");
      $message = 'User created successfully';
    } else {
      $message = 'Error creating user: ' . $conn->error;
    }
  }
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Signup Page</title>
  <style>
    body {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      background-color: darkslategray;
    }
    .container {
      background-image: url('flower.jpg');
      background-size: cover;
      margin-left: 30%;
      width: 40%;
      height: 70%;
      margin-top: 150px;
      text-align: center;
      color: white;
      border: 4px solid orange;
      border-radius: 20px; 
    }
    .container h1{
      color: black;
    }
    label{
      padding: 4px;
      padding-bottom: 5px;
      font-size: 20px;
      color: black;
    }
    input[type=text],[type=email],[type="password"]{
      margin-bottom: 5px;
      padding: 2px;
      padding-bottom: 5px;
    }
    input[type=submit]:hover{
      color: red;
      width: 150px;
    }
    .container p{
        color: black;
    }
  </style>
</head>
<body>



  <div class="container">
    <h1>Signup</h1>
    <form method="post">
      <label for="first_name">First Name:</label>
      <input type="text" name="first_name" required><br>

      <label for="last_name">Last Name:</label>
      <input type="text" name="last_name" required><br>

      <label for="username">Username:</label>
      <input type="text" name="username" required><br>

      <label for="email">Email:</label>
      <input type="email" name="email" required><br>

      <label for="password">Password:</label>
      <input type="password" name="password" required><br>

      <input type="submit" value="Signup">
      
      <?php 
      header('location: login.php')
      ?>
    </form>
    <label>Already Have an Account. Try <a href="login.php">Login</a></label>
    
  <?php if (!empty($message)) { ?>
    <p><?php echo $message; ?></p>
  <?php } ?>
  </div>

</body>
</html>