<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body{
        background-image: url(juan-gomez-9L0zCCeD6J4-unsplash.jpg);
        background-attachment: fixed;
        background-size: cover;

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
        .table{
            margin-top: 50px;

        }
</style>
</head>
<body>
<a href="login.php" class="backnw"><i class="fa-solid fa-arrow-left"></i> &nbsp; 
Back
</a>
<div class="container my-4">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Bill Date</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Bill Value</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php 
 
       include "connect.php"; // Check the path to connect.php
       
       // Initialize database connection
       $conn = new mysqli($host, $username, $password, $database); // Provide actual values
       
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       
       if(isset($_GET['delete_id'])) {
           $deleteId = $_GET['delete_id'];
           
           // Prepare the delete statement
           $deleteQuery = "DELETE FROM bills WHERE id = ?";
           $stmt = $conn->prepare($deleteQuery);
           $stmt->bind_param("i", $deleteId); // 'i' stands for integer, assuming id is an integer
           $deleteResult = $stmt->execute();
           
           if ($deleteResult) {
               echo "Deleted";
               header("Location: customer_bill_logs.php");
               exit;
           } else {
               echo "<p>Error deleting record: " . $conn->error . "</p>";
           }
           
           // Close the prepared statement
           $stmt->close();
       }
       
       // Modify the query to include the search functionality
       $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
       $query = "
           SELECT b.timestamp, b.bill_value, b.description, b.id, p.Name AS bill_name
           FROM bills b
           JOIN party p ON b.party_id = p.id
           WHERE b.timestamp LIKE '%$searchTerm%' OR p.Name LIKE '%$searchTerm%' OR b.bill_value LIKE '%$searchTerm%'
           ORDER BY b.timestamp
       ";
       $result = $conn->query($query);
       
       if ($result) {
           if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {

                   echo "<tr class='bill-row' data-row-id='{$row['id']}'>";
                   echo "<td>{$row['timestamp']}</td>";
                   echo "<td>{$row['bill_name']}</td>";
                   echo "<td>{$row['description']}</td>";
                   echo "<td>₹ {$row['bill_value']}</td>";
                   echo "<td><a href='' class='btn btn-danger btn-sm delete-button'>Delete</a></td>";
                   echo "</tr>";
               }
           } else {
               echo "<tr><td colspan='4'>No records found.</td></tr>";
           }
       } else {
           echo "<tr><td colspan='4'>Query error: " . $conn->error . "</td></tr>";
       }
       
       $conn->close();
    
       ?>
       
      
        
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();

            var row = button.closest(".bill-row");
            var rowId = row.dataset.rowId;

            // Send an AJAX request to delete the bill entry
            fetch('delete_billlog.php?id=' + rowId, {
                method: 'DELETE'
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Remove the deleted row from the table
                      row.remove();
                  } else {
                      console.error(data.message);
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
              });
        });
    });
});

</script>

</body>
</html>
