<?php

include_once("database/conn.php");

// Set content type to JSON
header("Content-Type: application/json");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate input data
    if (isset($data['user_id']) && isset($data['status'])) {
        $user_id = $data['user_id'];
        $status = $data['status'];
        $attendance_date = date("Y-m-d");
        $check_in_time = $data['check_in_time'];
        $check_out_time = $data['check_out_time'];
        $notes = $data['notes'];

        // Insert the attendance record into the database
        $sql = "INSERT INTO attendance (user_id, attendance_date, status, check_in_time, check_out_time, notes) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss",
             $user_id, $attendance_date, $status, $check_in_time, $check_out_time, $notes);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Attendance recorded successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to record attendance"]);
        }
        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Invalid data"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}

$conn->close();
?>

