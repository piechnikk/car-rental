<?php
$data = json_decode(file_get_contents('php://input'), true);
include('./hidden.php');

if (isset($data['car_id'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM cars INNER JOIN models ON cars.id_models = models.id_models WHERE cars.id_cars=$data[car_id]";
    $result = $conn->query($sql);
    $carsData = [];

    if ($result->num_rows) {
        while ($row = $result->fetch_assoc()) {
            $carsData[] = $row;
        }
    }

    $response = array('cars' => $carsData);
    echo json_encode($response);

    $conn->close();
}
