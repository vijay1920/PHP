<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
.container{
 
  margin: 15px 0;
  flex-wrap: wrap;

}
.add
{
  margin: 15px 0;
  margin-left: 105px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.new
{
  border: 0;
  background-color: cadetblue;
  color: aliceblue;
  padding: 5px 5px;
  border-radius: 5px;
  margin-right: 50px;

}
.printb
{
  border: 0;
  text-decoration: none;
  background-color:black;
  color: aliceblue;
  padding: 4px 4px;
border-radius: 5px;
}
.editb{
  
  text-decoration: none;
  border: 0;
  background-color:grey;
  color: aliceblue;
  padding: 4px 4px;
border-radius: 5px; 
margin-left: 2px;

}

.deleteb
{

  text-decoration: none;
  border: 0;
  background-color:rgb(196, 58, 58);
  color: aliceblue;
  padding: 4px 4px;
border-radius: 5px; 
margin-left: 2px;
}
.newparty
{
  text-decoration: none;
  border: 0;
  background-color:cornflowerblue;
  color: aliceblue;
  padding: 4px 4px;
border-radius: 5px; 
margin-left: 2px;
}
.table
{
  border: 1px solid black;
  background-color: rgba(43, 43, 43, 0.130);
backdrop-filter: blur(10px);
border: 2px solid rgba(255, 255, 255, 0.2);
}
body{
  background-image: url(loginh.jpg);
  background-size: cover;
  background-repeat: no-repeat;
}
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>


<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // In a real-world scenario, you should validate the input and use a database to check the credentials.
    // For this example, let's assume the correct credentials are "admin" for both username and password.
    $correctUsername = "admin";
    $correctPassword = "vmtex123";

    // Check if the provided credentials match the correct ones
    if ($username === $correctUsername && $password === $correctPassword) {
        // If credentials are correct, redirect to a welcome page or perform other actions.
        // For this example, we'll just echo a success message.
        echo "<p class='welmsg'>"."Login successful. Welcome, " . $username . "!"."</p>";
    } else {
        // If credentials are incorrect, store an error message in a session variable.
        session_start();
        $_SESSION['login_error'] = "Invalid credentials. Please try again.";
        header("Location: index.php"); // Redirect back to index.php
        exit();
    }
}



?>


<div class="add">
  <!-- Button trigger modal -->
 

  <a href="new.php"><button  class="new">
ADD NEW PARTY+
  </button></a>

 <a href="customer_bill_logs.php"><button  class="new">
RECENT BILL LOGS
  </button></a>


</div>

<div class="container my-4">

<form method="get"> <!-- Add a form element for the search -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" placeholder="search here">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">GST</th>
      <th scope="col">Phone</th>

      <th scope="col">Add new bill</th>
      <th scope="col">View Detail</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>

  <?php
include "connect.php"; // Check the path to connection.php

// Initialize database connection
$conn = new mysqli($host, $username, $password, $database); // Make sure to provide actual values for these variables

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from party";

$search = '';
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM party WHERE Name LIKE '%$search%' OR GST_no LIKE '%$search%' OR Phone LIKE '%$search%' ";
} else {
    $sql = "SELECT * FROM party";
}

$result = $conn->query($sql);

if (!$result) {
    die("INVALID QUERY");
}


while ($row = $result->fetch_assoc()) {
  echo "
    <tr>
    <th>$row[id]</th>
    <td>$row[Name]</td>
    <td>$row[GST_no]</td>
    <td>$row[Phone]</td>
    
    <td> <a href='./print.php?id=$row[id]'><button  class='new'>
    NEW BILL+
      </button></a></td>

    <td>
     <a href='./viewlog.php?id=$row[id]'><button  class='newparty'>view
  </button></a>
  </td>
 
  <td>
  <a class='editb' href='edit.php?id=$row[id]'>Edit</a>
        <a class='deleteb' href='./delete.php?id=$row[id]'> delete </a>
    </td>
  </tr>
  ";
}


// Close the database connection when done
$conn->close();
?>
  </tbody>
</table>

</div>





























</body>
</html>




