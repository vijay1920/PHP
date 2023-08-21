<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    
<?php
include "connect.php"; 

if(isset($_GET['bill_id']) && isset($_GET['party_id'])){
    $bill_id = $_GET['bill_id'];
    $party_id = $_GET['party_id'];

    // Retrieve the party details using the provided party_id
    $partyQuery = "SELECT * FROM party WHERE id = $party_id";
    $partyResult = $conn->query($partyQuery);

    if ($partyResult->num_rows > 0) {
        $partyRow = $partyResult->fetch_assoc();
        echo "<h2>Party Details:</h2>";
        echo "<p>ID: $partyRow[id]</p>";
        echo "<p>Bill Date: $partyRow[Bill_date]</p>";
        echo "<p>Name: $partyRow[Name]</p>";
        echo "<p>GST Number: $partyRow[GST_no]</p>";
        echo "<p>Phone: $partyRow[Phone]</p>";

        // Retrieve the bill log details using the provided IDs
        $billQuery = "SELECT * FROM Bills WHERE id = $bill_id AND party_id = $party_id";
        $billResult = $conn->query($billQuery);

        if ($billResult->num_rows > 0) {
            $billRow = $billResult->fetch_assoc();
            echo "<h2>Bill Log Details:</h2>";
            echo "<p>Timestamp: $billRow[timestamp]</p>";
            echo "<p>Bill Value: $billRow[bill_value]</p>";
            echo "<p>Description: $billRow[description]</p>";
            // Add any additional details you want to display

          echo"  <button class='print-invoice' onclick='window.print()'>Print Invoice</button>
            </div>";
            
        } else {
            echo "<p>No bill log found with the provided IDs.</p>";
        }
    } else {
        echo "<p>No party found with the provided party ID.</p>";
    }

    $conn->close();
} else {
    echo "<p>Invalid request parameters.</p>";
}
?>
</body>
</html>
