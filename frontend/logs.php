<<<<<<< HEAD
<?php

// $servername = "localhost";
// $username = "root";
// $password = "Smuget1000";
// $dbname = "ppc_stats";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
// mysqli_set_charset($conn,"utf8");

include '../backend/php/includes/db_conf.php';

$sql = "SELECT * FROM weather_service WHERE modifier = 'ACTIVE' ORDER BY moddate DESC";
$result = $conn->query($sql);
date_default_timezone_set("Europe/Oslo");
if ($result->num_rows > 0) {
    // output data of each row
    $campaign_name = "";
    while($row = $result->fetch_assoc()) {
    	//$newDate = date("d-m-Y H:m:s", strtotime($row["moddate"]));
		//echo $newDate;
        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["weather"]. "<br>";

        if ($campaign_name == $row["campaign"]) {
            echo '<tr>';
            echo '<th scope="row"><small>'.substr($row["moddate"], 0, -7).'</small></th>';
            echo '<td>'.'</td>';
            echo '<td>'.$row["city"].'</td>';
            echo '<td>'.$row["weather"].'</td>';
            echo '<td><small>'.$row["modifier"].'</small></td>';
            echo '</tr>';
        } else {
            $campaign_name = $row["campaign"];
            echo '<tr style="background-color: #bababa;">';
            echo '<th scope="row">'.substr($row["moddate"], 0, -7).'</th>';
            echo '<td>'.$row["campaign"].'</td>';
            echo '<td>'.$row["city"].'</td>';
            echo '<td>'.$row["weather"].'</td>';
            echo '<td><small>'.$row["modifier"].'</small></td>';
            echo '</tr>';
        }
    }
} else {
    echo "0 results";
}
$conn->close();

=======
<?php

// $servername = "localhost";
// $username = "root";
// $password = "Smuget1000";
// $dbname = "ppc_stats";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
// mysqli_set_charset($conn,"utf8");

include '../backend/php/includes/db_conf.php';

$sql = "SELECT * FROM weather_service WHERE modifier = 'ACTIVE' ORDER BY moddate DESC";
$result = $conn->query($sql);
date_default_timezone_set("Europe/Oslo");
if ($result->num_rows > 0) {
    // output data of each row
    $campaign_name = "";
    while($row = $result->fetch_assoc()) {
    	//$newDate = date("d-m-Y H:m:s", strtotime($row["moddate"]));
		//echo $newDate;
        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["weather"]. "<br>";

        if ($campaign_name == $row["campaign"]) {
            echo '<tr>';
            echo '<th scope="row"><small>'.substr($row["moddate"], 0, -7).'</small></th>';
            echo '<td>'.'</td>';
            echo '<td>'.$row["city"].'</td>';
            echo '<td>'.$row["weather"].'</td>';
            echo '<td><small>'.$row["modifier"].'</small></td>';
            echo '</tr>';
        } else {
            $campaign_name = $row["campaign"];
            echo '<tr style="background-color: #bababa;">';
            echo '<th scope="row">'.substr($row["moddate"], 0, -7).'</th>';
            echo '<td>'.$row["campaign"].'</td>';
            echo '<td>'.$row["city"].'</td>';
            echo '<td>'.$row["weather"].'</td>';
            echo '<td><small>'.$row["modifier"].'</small></td>';
            echo '</tr>';
        }
    }
} else {
    echo "0 results";
}
$conn->close();

>>>>>>> d050fcacf2240d7cd453e7c1bbe98685fd589609
?>