<?php
include('./hidden.php');

if (isset($_POST['id_cars']) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();

    
    $sql = "INSERT INTO reservations (id_users, id_cars, start_time, end_time) VALUES ('$_SESSION[id]', '$_POST[id_cars]', '$_POST[start_time]', '$_POST[end_time]')";
    $result = $conn->query($sql);

    echo "{\"msg\": true}";

    $conn->close();
}
