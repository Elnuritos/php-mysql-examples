<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}else{
    // define first
    $name = $surnames = $salary = $ycard = "";
    $rcard = $team = $goals = $assists=""; 
    require_once "config.php"; 
    if(isset($_POST['id'])&&(!empty(trim($_POST['id'])))){
        // Error - id was not defined
        $id = $_POST["id"];
        //var_dump($id);
        $name = trim($_POST["name"]);
        //var_dump($name);
        $surnames = trim($_POST["surname"]);
        //var_dump($surnames);
        $salary = trim($_POST["salary"]);
        $ycard = trim($_POST["ycard"]);
        $rcard = trim($_POST["rcard"]);
        $team = trim($_POST["team"]);
        $goals = trim($_POST["goals"]);
        $assists = trim($_POST["assists"]);
        // a vaidation must be added later
        
        if (!empty($name) && !empty($surnames) && !empty($salary) && !empty($ycard) && !empty($rcard) && !empty($goals) && !empty($assists)){
            // Error SQL was not correct    
            $sql = "UPDATE players SET name=?, surname=?, team=?, goals=?, assists=?, salary=?, ycard=?, rcard=? WHERE id=?";
                $stmt = $mysqli->prepare($sql);
                //var_dump($stmt);
                if($stmt = $mysqli->prepare($sql)){
                    $param_name=$name;
                    $param_surname=$surnames;
                    $param_team=$team;
                    $param_goals=$goals;
                    $param_assists=$assists;
                    $param_salary=$salary;
                    $param_ycard=$ycard;
                    $param_rcard=$rcard;
                    $param_id=$id;
                    $stmt->bind_param("sssiiiiii", $param_name,$param_surname,$param_team,$param_goals,$param_assists,$param_salary,$param_ycard,$param_rcard,$param_id);
                    //var_dump($param_id);
                    //var_dump($param_surname);
                    //var_dump($param_name);
                    if($stmt->execute()){
                        // Records updated successfully. Redirect to landing page
                        header("location: index.php");
                        exit();
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }
                 // Close statement
            $stmt->close();
        }
    
    // Close connection
    $mysqli->close();
}else{ 
 if(isset($_GET['id'])&&!empty(trim($_GET['id']))){
       
      
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
                    $get_name=$row['name'];
                    $get_surnames=$row['surname'];
                    $get_goals=$row['goals'];
                    $get_assists=$row['assists'];
                    $get_ycard=$row['ycard'];
                    $get_rcard=$row['rcard'];
                    $get_salary=$row['salary'];
                    $get_team=$row['team'];
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
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])) ?>" method="post">
                        <div class="form-group ">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $get_name; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $get_surnames; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>Team</label>
                            <input type="text" name="team" class="form-control" value="<?php echo $get_team; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>goals</label>
                            <input type="number" name="goals" class="form-control" value="<?php echo $get_goals; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>assists</label>
                            <input type="number" name="assists" class="form-control" value="<?php echo $get_assists; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>yellow cards</label>
                            <input type="number" name="ycard" class="form-control" value="<?php echo $get_ycard; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>red cards</label>
                            <input type="number" name="rcard" class="form-control" value="<?php echo $get_rcard; ?>">
                            <span class="help-block"></span>
                        </div>
                        
                        
                        <div class="form-group ">
                            <label>Salary</label>
                            <input type="number" name="salary" class="form-control" value="<?php echo $get_salary; ?>">
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