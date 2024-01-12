<?php

require_once "C:\xampp\htdocs\FYP\Source\db.php";

$sql = "SELECT  * FROM universities";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $universities = array();
    while ($row = $result->fetch_assoc()) {
        $universities[] = $row;
    }

    echo json_encode(array(
        "success" => true,
        "universities" => $universities
    ));
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "Error fetching universities"
    ));
}

$conn->close();
