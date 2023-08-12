<?php
$data = json_decode(file_get_contents('php://input'), true);
include('./hidden.php');

// Create connection
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$sql = "SELECT * FROM reservations INNER JOIN cars ON reservations.id_cars = cars.id_cars INNER JOIN models ON cars.id_models = models.id_models WHERE $_SESSION[id] = id_users";
$result = $conn->query($sql);
$userReservateData = [];

if ($result->num_rows) {
    while ($row = $result->fetch_assoc()) {
        $userReservateData[] = $row;
    }
}

$response = array('reservations' => $userReservateData, 'id_users' => $_SESSION["id"]);
echo json_encode($response);

$conn->close();
