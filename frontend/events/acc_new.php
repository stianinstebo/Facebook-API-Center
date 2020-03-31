<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ppc_stats";

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $services = $_POST['services'];
    $pri = $_POST['pri'];
    $status = $_POST['status'];
    $change = $_POST['change'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    mysqli_set_charset($conn, "utf8");

    $check = "SELECT * FROM accounts WHERE cid = '$cid'";

    $rs = mysqli_query($conn, $check);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);
    
    if($data[0] > 1) {
        echo "User Already in Exists<br/>";
        if ($change == "update") {
            $sqlUpdate = "UPDATE accounts SET name='$name', services='$services', pri='$pri' WHERE cid='$cid' LIMIT 1";
            if ($conn->query($sqlUpdate) === TRUE) {
                echo "Update account";
            } else {
                echo "Error updating customer: " . $conn->error;
            }
        } else {

        }
    } else {
        $sql = "INSERT INTO accounts (id, cid, name, services, status, pri)
        VALUES ('', '$cid', '$name', '$services', '$status', '$pri')";

        if ($conn->query($sql) === TRUE) {
            echo "Created customer";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();






    // $con=mysqli_connect("localhost","root","","my_db");
    // $check="SELECT * FROM persons WHERE Email = '$_POST[eMailTxt]'";
    // $rs = mysqli_query($con,$check);
    // $data = mysqli_fetch_array($rs, MYSQLI_NUM);
    // if($data[0] > 1) {
    //     echo "User Already in Exists<br/>";
    // }

    // else
    // {
    //     $newUser="INSERT INTO persons(Email,FirstName,LastName,PassWord) values('$_POST[eMailTxt]','$_POST[NameTxt]','$_POST[LnameTxt]','$_POST[passWordTxt]')";
    //     if (mysqli_query($con,$newUser))
    //     {
    //         echo "You are now registered<br/>";
    //     }
    //     else
    //     {
    //         echo "Error adding user in database<br/>";
    //     }
    // }

?>
