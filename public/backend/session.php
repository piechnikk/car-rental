<?php
session_start();

include('./hidden.php');

if (isset($_SESSION["id"])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE $_SESSION[id] = id_users";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
    }
    echo "{\"logged\": true, \"user_id\":" . $_SESSION["id"] . ",\"account_type\":\"" . $row["account_type"] . "\"}";
} else {
    echo '{"logged": false}';
}
