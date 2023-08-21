<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
        body{
            background-image: url(printh.jpg);
            background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
        }
        .partydetail
        {
            height: auto;
            width: 450px;
            background-color:white;
            padding: 20px;

padding-left: 30px;
color: black;
margin-top: 50px;
font-weight: 700;
        }
        .backnw
        {
            position: absolute;
            top: 15px;
            left: 25px;
            text-decoration: none;
            
            color: white;
            height: 30px;
            width: 80px;
      align-items: center;
      display: flex;
      justify-content: center;
            border: 1p solid black;
            border-radius: 10px;
            background-color: black;
        }
        .deletebtn
        {
            background-color: rgb(196, 58, 58);
    color: black;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
        }
        .printbtn
        {
            background-color:cornflowerblue;
    color: black;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
        }
    
    </style>
</head>
<body>

<a href="login.php" class='backnw'><i class="fa-solid fa-arrow-left"></i> &nbsp; Back</a>
<div class="container my-4">
<table class="table">
<thead>
  <tr>
    <th >Date</th>
    <th >Bill_value</th>
    <th >Description</th>
    <th >Action</th>
    <th>Print</th>
  </tr>
</thead>
<tbody>

    
    <?php
    include "connect.php"; 

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // Your database connection settings here

        $sql = "SELECT * FROM party WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "
            <div class='partydetail'>
            <p>ID: $row[id]</p>
            <p>Bill Date: $row[Bill_date]</p>
            <p>Name: $row[Name]</p>
            <p>GST Number: $row[GST_no]</p>
            <p>Phone: $row[Phone]</p>
            <p>Address: $row[Address]</p>
            </div>

            ";
          
            // Retrieve and display bill logs
            $billQuery = "SELECT * FROM Bills WHERE party_id = $id";


            $billResult = $conn->query($billQuery);

            if ($billResult->num_rows > 0) {
                echo "<h2>Bill Logs:</h2>";
                echo "<ul>";
                while ($billRow = $billResult->fetch_assoc()) {
echo "

<tr>
    <th>$billRow[timestamp]</th>
    <td>₹ $billRow[bill_value]</td>
    <td>$billRow[description]</td>
   <td> <a href='./delete_bill.php?bill_id=$billRow[id]&party_id=$id'  class='deletebtn'>Delete</a> </td>
  
   
   <td>

<a href='./printf.php?bill_id=$billRow[id]&party_id=$id'   class='printbtn'>Print</a>



 </td>


    </tr>
   
";

                //     echo "<li>Bill Value: $billRow[bill_value], Description: $billRow[description], DATE: $billRow[timestamp]";
                //     echo " <a href='./delete_bill.php?bill_id=$billRow[id]&party_id=$id'>Delete</a></li>";
                // 
                }
                echo "</ul>";
            } else {
                echo "<p>No bill logs found for this customer.</p>";
            }
        }

        $conn->close();
    } 
    ?>
</tbody>
</table>

</div>
</body>
</html>
