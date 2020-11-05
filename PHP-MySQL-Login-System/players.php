<?php
/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u1150524_test');
define('DB_PASSWORD', 'N9r8D8n6');
define('DB_NAME', 'u1150524_test');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
/* echo "Connect Successfully. Host info: " . $mysqli->host_info; */

$sql="SELECT * FROM players";
$counter=1;
if ($res=$mysqli->query($sql)){
    if($res->num_rows>0){
        echo "<table>";
    while($row = $res->fetch_array()){
    echo "<tr>";
        
        echo "<td>" .$counter. "</td>";
        $counter+=1;
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['surname'] . "</td>";
        echo "<td>" . $row['team'] . "</td>";
        echo "<td>" . $row['goals'] . "</td>";
        echo "<td>" . $row['assists'] . "</td>";
        echo "<td>" . $row['ycard'] . "</td>";
        echo "<td>" . $row['rcard'] . "</td>";
    echo "</tr>";
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
