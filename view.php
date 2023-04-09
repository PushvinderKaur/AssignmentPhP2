<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
  // Redirect to login page
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View data</title>
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
        table{
            margin-top: 10px;
            width: 100%;
            border: 2px solid white;
            padding: 10px;
        }
        table th{
            width: 200px;
            color: white;
            border: 2px solid white;
        }
        table td{
            color: white;
            text-align: center;
            padding-top: 10px;
        }
        table td .update{
            background-color: blue;
            color: white;
            text-decoration:  none;
        }
        table td .delete{
            background-color: red;
            color: white;
            text-decoration:  none;
        }
        table td .update:hover{
            text-decoration: underline;
        }
        table td .delete:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" target="_self">Home</a>
        <a href="add.php" target="_self">Add Data</a>
    </header>
    <table>
        <th>Student ID</th>
        <th>Name</th>
        <th>email</th>
        <th>GPA</th>
        <th>Program</th>
        <th>Files</th>
        <th>Operation</th>
        <?php
        include "conn.php";
        
        $sql = "Select * FROM `students`";
        $result = mysqli_query($conn, $sql);

        // check if any data was returned
        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){
                $id = $row['student_id'];
                $name = $row['name'];
                $email = $row['email'];
                $gpa = $row['gpa'];
                $program = $row['program'];
                $files = $row['file_path'];
                if ($files) {
                  echo '<tr>
                    <td scope="row">'.$id.'</td>
                    <td>'.$name.'</td>
                    <td>'.$email.'</td>
                    <td>'.$gpa.'</td>
                    <td>'.$program.'</td>
                    <td><img src="'.$files.'" width="100px"" height="100px"></td>
                    <td>
                    <button class="update"><a href="update.php?updateid='.$id.'" class="update">Update</a></button>
                    <button class="delete"><a href="delete.php?deleteid='.$id.'" class="delete">Delete</a></button>
                    </td>
                  </tr>';
                } else {
                  echo '<tr>
                    <td scope="row">'.$id.'</td>
                    <td>'.$name.'</td>
                    <td>'.$email.'</td>
                    <td>'.$gpa.'</td>
                    <td>'.$program.'</td>
                    <td></td>
                    <td>
                    <button class="update"><a href="update.php?updateid='.$id.'" class="update">Update</a></button>
                    <button class="delete"><a href="delete.php?deleteid='.$id.'" class="delete">Delete</a></button>
                    </td>
                  </tr>';
                }
            }
    
            echo "</table>";
    }
        ?>
    </table>
</body>
</html>