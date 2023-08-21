<?php
// delete_billlog.php

include "connect.php"; // Include your database connection details

if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    // Prepare the delete statement for bills data
    $deleteQuery = "DELETE FROM bills WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $deleteId); // 'i' stands for integer, assuming id is an integer
    $deleteResult = $stmt->execute();
    $stmt->close();

    if ($deleteResult) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false, "message" => "Error deleting record: " . $conn->error);
    }
} else {
    $response = array("success" => false, "message" => "Invalid request");
}

header("Content-Type: application/json");
echo json_encode($response);
?>
