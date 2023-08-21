<?php
include "connect.php";

if(isset($_POST['Name'])){
    $Name = $_POST['Name'];

    $q = "SELECT * FROM `party` WHERE `Name` = '$Name'";
    $query = mysqli_query($conn, $q);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $data = array(
            'GST_no' => $row['GST_no'],
            'Phone' => $row['Phone'],
            'Bill_value' => $row['Bill_value']
        );
        echo json_encode($data);
    }
}
?>
