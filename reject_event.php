<?php
require 'C:\xampp\htdocs\FYP\Source\db.php';

// Get event ID from POST request
$eventID = mysqli_real_escape_string($conn, $_POST["event_id"]);

// Remove event from pending_events table
$sql = "DELETE FROM pending_events WHERE id = '$eventID'";
$conn->query($sql);

if ($conn->error) {
  $response = array(
    "success" => false,
    "message" => "Error rejecting event: " . $conn->error
  );
} else {
  $response = array(
    "success" => true,
    "message" => "Event rejected successfully!"
  );
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>