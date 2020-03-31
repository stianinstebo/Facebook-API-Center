<?php

include '../backend/php/includes/db_conf.php';

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);
// date_default_timezone_set("Europe/Oslo");
if ($result->num_rows > 0) {
    // output data of each row
    $campaign_name = "";
    while($row = $result->fetch_assoc()) {
        //$newDate = date("d-m-Y H:m:s", strtotime($row["moddate"]));
        //echo $newDate;
        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["weather"]. "<br>";

        echo '<tr>';
        echo '<th scope="row">act_'.$row["cid"].'</th>';
        echo '<td>'.$row["name"].'</td>';
        if (strpos($row["services"], 'weather') !== false) {
            // echo '<td><input type="checkbox" value="weather" onclick="update_service('."'".$row["cid"]."', 1".')" checked /></td>';
            echo '<td><i class="material-icons">check</i></td>';
        } else {
            // echo '<td><input type="checkbox" value="weather" onclick="update_service('."'".$row["cid"]."', 1".')" /></td>';
            echo '<td></td>';
        }
        if (strpos($row["services"], 'event') !== false) {
            // echo '<td><input type="checkbox" value="weather" onclick="update_service('."'".$row["cid"]."', 2".')" checked /></td>';
            echo '<td><i class="material-icons">check</i></td>';
        } else {
            // echo '<td><input type="checkbox" value="weather" onclick="update_service('."'".$row["cid"]."', 2".')" /></td>';
            echo '<td></td>';
        }
        if (strpos($row["services"], 'season') !== false) {
            // echo '<td><input type="checkbox" value="weather" onclick="update_service('."'".$row["cid"]."', 3".')" checked /></td>';
            echo '<td><i class="material-icons">check</i></td>';
        } else {
            // echo '<td><input type="checkbox" value="weather" onclick="update_service('."'".$row["cid"]."', 3".')" /></td>';
            echo '<td></td>';
        }
        if ($row['status'] == 1) {
            echo '<td><center><button type="button" class="btn btn-info btn-sm" onclick="toggle_customer('.$row["id"].",0".')">Aktiv</button></center></td>';
        } else {
            echo '<td><center><button type="button" class="btn btn-warning btn-sm" onclick="toggle_customer('.$row["id"].",1".')">Stoppet</button></center></td>';
        }
        echo '<td><button type="button" class="btn btn-secondary btn-sm" onclick="edit_customer('."'".$row["cid"]."',"."'".$row["name"]."',"."'".$row["services"]."',"."'".$row["pri"]."'".')">Rediger</button></td>';
        echo '</tr>';
    }
} else {
    echo "0 results";
}
$conn->close();

?>