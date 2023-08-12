<?php
include('./hidden.php');
if (isset($_POST['id_reservations']) && isset($_POST['status']) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE reservations SET reservations.status='$_POST[status]', reservations.start_time='$_POST[start_time]', reservations.end_time='$_POST[end_time]'  WHERE reservations.id_reservations=$_POST[id_reservations]";
    if ($conn->query($sql) === true)
        echo "{\"update\": true}";

    $conn->close();
}
