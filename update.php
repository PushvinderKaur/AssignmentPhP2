<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: darkslategray;
        }
        header{
            background-color: #2C3333;
            height: 30px;
            text-align: right;
        }
        header a{
            padding-left: 19px;
            display: inline-block;
            color: #DFFFD8;
            font-size: 25px;
            text-decoration: none;
        }
        .container {
            background-image: url('flower.jpg');
            background-size: cover;
            margin-left: 30%;
            width: 40%;
            height: 70%;
            margin-top: 150px;
            text-align: center;
            color: black;
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
    </style>
</head>
<body>
    <header>
        <a href="index.php" target="_self">Home</a>
        <a href="view.php" target="_self">View Data</a>
    </header>
    <div class="container">
        
    <h1> Update Data</h1>
    <form method="post">

      <label for="name">Name:</label>
      <input type="text" name="name" required><br>

      <label for="email">Email:</label>
      <input type="email" name="email" required><br>

      <label for="GPA">GPA:</label>
      <input type="text" name="gpa" required><br>

      <label for="program">Program:</label>
      <input type="text" name="program" required><br>

      <a href="index.php"><input type="submit" value="Update"></a>
    </form>
    </div> 
</body>
</html>

<?php
include "conn.php";
$id = $_GET["updateid"];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // form data
    $student_id = $_POST["student_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gpa = $_POST["gpa"];
    $program = $_POST["program"];

    // sql
    $stmt = $conn->prepare("update `students` set student_id=$id,name='$name', email='$email', gpa='$gpa', program='$program' where student_id=$id"); 

    // execution
    if ($stmt->execute()) {
        header("Location: view.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // close
    $stmt->close();
    $conn->close();
}
  
?>