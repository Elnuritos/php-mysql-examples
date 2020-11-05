<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");

    exit;
}else{


if(isset($_GET['id'])&&(!empty(trim($_GET['id'])))){
    require_once "config.php";
  
   $sql="SELECT * FROM players WHERE id=?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters


        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $res = $stmt->get_result();
            if($res->num_rows==1){
                $row = $res->fetch_array();
                $names=$row['name'];
                $surnames=$row['surname'];
                $goals=$row['goals'];
                $assists=$row['assists'];
                $ycard=$row['ycard'];
                $rcard=$row['rcard'];
                $salary=$row['salary'];
                $team=$row['team'];
            }else{
                echo "No players found";
            }   

        }else{
           
            echo "ERROR: couldnt get the result";


        }
    }
}else{
    // URL doesn't contain id parameter. Redirect to error page
     header("location: error.php");
    exit();
    
}
   
} 

   
   
   ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    </head>
    <body>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row['name'] ?></p>
                    </div>
                    <div class="form-group">
                        <label>Surname</label>
                        <p class="form-control-static"><?php echo $surnames ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p class="form-control-static"><?php echo $salary ?></p>
                    </div>
                    <div class="form-group">
                        <label>Team</label>
                        <p class="form-control-static"><?php echo $team ?></p>
                    </div>
                    <div class="form-group">
                        <label>Goals</label>
                        <p class="form-control-static"><?php echo $goals ?></p>
                    </div>
                    <div class="form-group">
                        <label>Assists</label>
                        <p class="form-control-static"><?php echo $assists ?></p>
                    </div>
                    <div class="form-group">
                        <label>Yellow cards</label>
                        <p class="form-control-static"><?php echo $ycard ?></p>
                    </div>
                    <div class="form-group">
                        <label>Red cards</label>
                        <p class="form-control-static"><?php echo $rcard ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>

    </body>
    </html>