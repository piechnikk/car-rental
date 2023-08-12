<?php
include('./hidden.php');

if (isset($_POST['id_users']) && isset($_POST['account_type'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE users SET users.account_type='$_POST[account_type]' WHERE users.id_users=$_POST[id_users]";
    if ($conn->query($sql) === true)
        echo "{\"changeType\": true}";

    $conn->close();
}
