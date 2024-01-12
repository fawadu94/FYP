<?php 
/* require 'C:\xampp\htdocs\FYP\db.php';

// Get event ID from POST request
$eventID = mysqli_real_escape_string($conn, $_POST["event_id"]);

// Update event status to "approved"
$sql = "UPDATE pending_events SET status = 'approved' WHERE id = '$eventID'";
$conn->query($sql);

if ($conn->error) {
  $response = array(
    "success" => false,
    "message" => "Error approving event: " . $conn->error
  );
} else {
  // Move event data to approved_events table (optional)
  // ...

  // Optionally, delete event from pending_events table
  // ...

  $response = array(
    "success" => true,
    "message" => "Event approved successfully!"
  );
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
*/


require 'C:\xampp\htdocs\FYP\Source\db.php';

// Get event ID and action from POST request
$eventID = mysqli_real_escape_string($conn, $_POST["event_id"]);
$action = mysqli_real_escape_string($conn, $_POST["action"]);

// Handle action based on value
switch ($action) {
  case "approve":
    // Update event status to "approved"
    $sql = "UPDATE pending_events SET status = 'approved' WHERE id = '$eventID'";
    $conn->query($sql);

    if ($conn->error) {
      $response = array(
        "success" => false,
        "message" => "Error approving event: " . $conn->error
      );
    } else {
      // Move event data to approved_events table (optional)
      // ...

      // Optionally, delete event from pending_events table
      // ...

      $response = array(
        "success" => true,
        "message" => "Event approved successfully!"
      );
    }
    break;

  default:
    $response = array(
      "success" => false,
      "message" => "Invalid action."
    );
    break;
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();

?> 
