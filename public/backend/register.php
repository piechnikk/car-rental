<?php
$data = json_decode(file_get_contents('php://input'), true);
include('./hidden.php');

if (isset($data['login']) && isset($data['password'])) {
    // Create connection
    $conn = new mysqli($host, $user, $passwd, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM users WHERE users.login='$data[login]'";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        echo "{\"registered\": false}";
    } else {
        $sql = "INSERT INTO users (login, password) VALUES ('$data[login]', SHA1('$data[password]'))";
        if ($conn->query($sql) === true)
            echo "{\"registered\": true}";
    }

    $conn->close();
}
