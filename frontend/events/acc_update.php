<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ppc_stats";

    $cid = $_POST['cid'];
    $status = $_POST['status'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    mysqli_set_charset($conn,"utf8");

    $sql = "UPDATE accounts SET status='$status' WHERE id='$cid' LIMIT 1";

    if ($conn->query($sql) === TRUE) {
        echo "Updated customer";
    } else {
        echo "Error updating customer: " . $conn->error;
    }


    $conn->close();

?>
