<?php


include "connect.php";

$success_message = "";

    if(isset($_GET['id']))
        $id = $_GET['id'];

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'vmtex';

        $conn = new mysqli($host, $username, $password, $database);

        // Retrieve the specific row's data
        $sql = "SELECT * FROM party WHERE id = $id";
        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
    
    echo "<h2>Creating a Bill for Party ID: $id</h2>";
    echo "<p>Party Name: $partyData[Name]</p>";
    
    // Create the bill form
    echo "
    <form action='process_bill.php' method='POST'>
        <!-- Your bill form fields here -->
        <input type='hidden' name='party_id' value='$id'>
        <!-- ... Other bill form fields ... -->
        <button type='submit' class='btn btn-primary'>Create Bill</button>
    </form>
    ";
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>CRUD</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  

</head>
<body>

 <div class="col-lg-6 m-auto">
 <a href="login.php">BACK</a>

 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header bg-primary">
 <h1 class="text-white text-center">  Add New Bill</h1>
 </div><br>

 <label> NAME: </label>
 <input type="text" name="Name" class="form-control"> <br>

 <label> GST_no: </label>
 <input type="text" name="GST_no" class="form-control"> <br>

 <label> PHONE: </label>
 <input type="text" name="Phone" class="form-control"> <br>

 <label> Bill_value: </label>
 <input type="text" name="Bill_value" class="form-control" placeholder="₹"><br>



            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
 

 <button class="btn btn-success" type="submit" name="submit">Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="login.php"> Cancel </a><br>


 </div>
 </form>
 </div>

</body>
</html>