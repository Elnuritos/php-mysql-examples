<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");

    exit;
}
 // Include config file
 require_once "config.php";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
   <!--  display players -->
    <?php
   
    $sql="SELECT * FROM players";
    $counter=1;
    if ($res=$mysqli->query($sql)){
        if($res->num_rows>0){
           echo "<table class='table table-bordered'>";
           echo  "<thead>";
           echo  "<tr table-info>";
           echo   "<th scope='col' class='text-center'>ID</th>";
           echo    "<th scope='col' class='text-center'>Name</th>";
           echo   " <th scope='col'class='text-center' >Surname</th>";
           echo    "<th scope='col' class='text-center'>Team</th>";
           echo    "<th scope='col' class='text-center'>actions</th>";
           echo " </tr>";
           echo  "</thead>";
        while($row = $res->fetch_array()){
       
         
            echo "<td>" .$counter. "</td>";
            
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['team'] . "</td>";
            echo "<td>";
                            
                                    echo "<a href='view.php?id=". $row['id'] ."' title='View player' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                    echo "<a href='update.php?id=". $row['id'] ."' title='Update player' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                    echo "<a href='delete.php?id=". $row['id'] ."' title='Delete player' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            echo "</td>";
        echo "</tr>";
        $counter+=1;
    }
    echo "</table>";
    $res->free();
        }else{
        echo "<h1>No players found</h1>";
        }
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
    
    $mysqli->close();
    /* var_dump($res->num_rows); */
    
    
    ?>

    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>