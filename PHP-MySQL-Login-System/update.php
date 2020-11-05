<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");

    exit;
}else{
    require_once "config.php";
    if(isset($_POST['id'])&&(!empty(trim($_POST['id'])))){
        $name = $_POST["name"];
        $surnames = $_POST["surname"];
        $salary = $_POST["salary"];
        $ycard = $_POST["ycard"];
        $rcard = $_POST["rcard"];
        $team = $_POST["team"];
        $goals = $_POST["goals"];
        $assists = $_POST["assists"];
        
        if (!empty(trim($name)) && !empty(trim($surnames)) && !empty(trim($salary)) && !empty(trim($ycard)) && !empty(trim($rcard)) && !empty(trim($goals)) && !empty(trim($assists))){
        $sql="UPDATE players SET name=?, surnames=? WHERE id=?";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("ssi", $param_name,$param_surname,$param_id);
            $param_name=$name;
            $param_surname=$surname;
            $param_id=$id;
            var_dump($param_id);
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
      /*   $stmt->close(); */
    }
    
    // Close connection
    $mysqli->close();
}else{ 
 if(isset($_GET['id'])&&(!empty(trim($_GET['id'])))){
       
      
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
    } 

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                        <div class="form-group ">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $names ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="Mendel">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>Team</label>
                            <input type="text" name="team" class="form-control" value="Barselona">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>goals</label>
                            <input type="number" name="goals" class="form-control" value="3">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>assists</label>
                            <input type="number" name="assists" class="form-control" value="2">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>yellow cards</label>
                            <input type="number" name="ycard" class="form-control" value="2">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>red cards</label>
                            <input type="number" name="rcard" class="form-control" value="2">
                            <span class="help-block"></span>
                        </div>
                        
                        
                        <div class="form-group ">
                            <label>Salary</label>
                            <input type="number" name="salary" class="form-control" value="5000">
                            <span class="help-block"></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>