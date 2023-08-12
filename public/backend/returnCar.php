<?php
include('./hidden.php');
if (isset($_POST['id_reservations'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE reservations SET reservations.status='ended' WHERE reservations.id_reservations=$_POST[id_reservations]";
    if ($conn->query($sql) === true)
        echo "{\"ended\": true}";

    $conn->close();
}
