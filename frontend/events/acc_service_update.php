<?php

    $servername = "localhost";
    $username = "root";
    $password = "Smuget1000";
    $dbname = "ppc_stats";

    $cid = $_GET['cid'];
    $services = $_GET['services'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    mysqli_set_charset($conn,"utf8");
    

    $sqlOrg = "SELECT * FROM accounts WHERE cid='$cid'";
    $resultOrg = $conn->query($sqlOrg);
    // date_default_timezone_set("Europe/Oslo");
    if ($resultOrg->num_rows > 0) {
        // output data of each row
        while($row = $resultOrg->fetch_assoc()) {
            $servicesString = $row['services'];

            switch ($services) {
                case 1:
                    if (strpos($servicesString, 'weather') !== false) {
                    //True
                    $servicesStringAdd = str_replace("weather", "", $servicesString);
                    $sql = "UPDATE accounts SET services='$servicesStringAdd' WHERE cid='$cid' LIMIT 1";

                    if ($conn->query($sql) === TRUE) {
                        echo "removed customer";
                    } else {
                        echo "Error updating customer: " . $conn->error;
                    }
                } else {
                    //False
                    echo $servicesString .= 'weather';

                    $sql = "UPDATE accounts SET services='$servicesString' WHERE cid='$cid' LIMIT 1";

                    if ($conn->query($sql) === TRUE) {
                        echo "added customer";
                    } else {
                        echo "Error updating customer: " . $conn->error;
                    }
                } 
                break;

                case 3:
                    if (strpos($servicesString, 'season') !== false) {
                    //True
                    $servicesStringAdd = str_replace("season", "", $servicesString);
                    $sql = "UPDATE accounts SET services='$servicesStringAdd' WHERE cid='$cid' LIMIT 1";

                    if ($conn->query($sql) === TRUE) {
                        echo "Removed service season";
                    } else {
                        echo "Error updating customer: " . $conn->error;
                    }
                } else {
                    //False
                    echo $servicesString .= 'season';

                    $sql = "UPDATE accounts SET services='$servicesString' WHERE cid='$cid' LIMIT 1";

                    if ($conn->query($sql) === TRUE) {
                        echo "Add to cu Updated customer";
                    } else {
                        echo "Error updating customer: " . $conn->error;
                    }
                } 
                break;

                case 2:
                    if (strpos($servicesString, 'event') !== false) {
                    //True
                        $servicesStringAdd = str_replace("event", "", $servicesString);
                        $sql = "UPDATE accounts SET services='$servicesStringAdd' WHERE cid='$cid' LIMIT 1";

                        if ($conn->query($sql) === TRUE) {
                            echo "Removed Service";
                        } else {
                            echo "Error updating customer: " . $conn->error;
                        }
                    } else {
                        //False
                        echo $servicesString .= 'event';

                        $sql = "UPDATE accounts SET services='$servicesString' WHERE cid='$cid' LIMIT 1";

                        if ($conn->query($sql) === TRUE) {
                            echo "Added Service";
                        } else {
                            echo "Error updating customer: " . $conn->error;
                        }
                    }
                break;

                default:
                break;
            }

            
        }
    } else {
        echo "0 results";
    }

    $conn->close();

?>