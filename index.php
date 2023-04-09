<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
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
        header #username{
            display: inline-block;
            text-align: right;
            color: white;
        }
        .container a{
            border: 2px solid Black;
            display: inline-block;
            width: 10%;
            text-decoration: none;
            color: Blue; 
        }
    </style>
</head>
<body>
    <header>
        <a href="signup.php" target="_self">Signup</a>
        <a href="login.php" target="_self">Login</a>
        <a href="logout.php" target="_self">Logout</a>&nbsp;
        <?php 
            session_start(); // start the session
            if (isset($_SESSION['username'])) {
                echo '<div id="username">' . $_SESSION['username'] . '</div>';
            }
        ?>
    </header>
    <div class="container">
        <h1>WELCOME TO STUDENT PORTAL</h1>
        <a href="add.php" target="_self">Add Data</a>
        <a href="view.php" target="_self">View Data</a>
    </div> 
</body>
</html>