<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
        body {
            background-image: url(newbillh.jpg);
            background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;

  display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .invoice-template{
            margin-top: 200px;
            height: 400px;
            width: 400px;
            background-color: rgba(43, 43, 43, 0.130);
backdrop-filter: blur(2px);
border: 2px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .backnw
        {
            position: absolute;
            top: 15px;
            left: 25px;
            text-decoration: none;
            
            color: black;
            height: 30px;
            width: 80px;
      align-items: center;
      display: flex;
      justify-content: center;
            border: 1p solid black;
            border-radius: 10px;
            background-color: white;
        }
        .barhead{
            align-items: center;
      display: flex;
      justify-content: center;
      color:azure;
        }
      .bar
      {
        width: 250px;
        margin: 15px;
        height: 25px;
        
        border: none;
        align-items: center;
      display: flex;
      justify-content: center;
      }

    .bar2{
        height: 65px;
        width: 250px;
        margin: 15px;
   
        border: none;
        align-items: center;
      display: flex;
      justify-content: center;
      }
      .billbtn
      {
     position: absolute;
     bottom: 20px;
     right: 50px;
     height: 30px;
     width: 100px;
     border: none;
     border-radius:10px ;
     background-color: bisque;
      }
      .alert
      {
        color: white;
        position: absolute;
        bottom: 100px;
        left:380px;
      }
      i{
        color: black;
      }
      
  
    </style>
</head>
<body>
<a href='login.php' class='backnw'><i class="fa-solid fa-arrow-left"></i> &nbsp; BACK</a> 
    <?php
    include "connect.php"; 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Don't redefine connection settings if already included
        // include "connect.php"; // Remove this line

        $sql = "SELECT * FROM party WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "
            <div class='invoice-template'>

            
                
       
                <form method='post' action=''>
                    <label class='barhead'> <strong>Bill Value:</strong> </label>
                    <input class='bar' type='text' name='Bill_value' placeholder='₹'><br>
    
                    <label class='barhead' > <strong>Description:</strong> </label>
                    <input class='bar2' type='text' name='Description'><br>
                 
                    <button type='submit' name='submit' class='billbtn'>Submit</button>
                </form>

                
            </div>
            ";
        }

        if (isset($_POST['submit'])) {
            $Description = $_POST['Description'];
            $Bill_value = $_POST['Bill_value'];

            $insertQuery = "INSERT INTO `bills` (`party_id`, `Description`, `Bill_value`) VALUES ('$id', '$Description', '$Bill_value')";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
                echo "<div class='alert alert-success'>Data added successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>
