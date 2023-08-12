<?php
include('./hidden.php');

if (isset($_POST['id_reservations'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    $sql = "DELETE FROM reservations WHERE id_users='$_SESSION[id]' AND id_reservations='$_POST[id_reservations]'";
    $result = $conn->query($sql);

    echo "{\"msg\": false}";
    

    $conn->close();
}
