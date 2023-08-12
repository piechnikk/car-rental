<?php
$data = json_decode(file_get_contents('php://input'), true);
include('./hidden.php');

// Create connection
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE login<>'admin'";
$result = $conn->query($sql);
$returnData = [];

if ($result->num_rows) {
    while ($row = $result->fetch_assoc()) {
        $returnData[] = $row;
    }
}

echo json_encode($returnData);

$conn->close();
