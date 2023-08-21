<?php
include "connect.php";

if (isset($_GET['bill_id']) && isset($_GET['party_id'])) {
    $billId = $_GET['bill_id'];
    $partyId = $_GET['party_id'];

    $deleteQuery = "DELETE FROM Bills WHERE id = $billId AND party_id = $partyId";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        header("Location: viewlog.php?id=$partyId"); // Redirect back to customer details
    } else {
        echo "Error deleting bill: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
