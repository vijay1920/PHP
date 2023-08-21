<?php


include "connect.php";


$success_message = "";

if (isset($_POST['submit'])) {
    $Name = $_POST['Name'];
    $GST_no = $_POST['GST_no'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];


        $q = "INSERT INTO `party`(`Name`, `GST_no`, `Phone`, `Address`) VALUES ('$Name', '$GST_no', '$Phone', '$Address')";
        $query = mysqli_query($conn, $q);

        if ($query) {
            $success_message = "Data added successfully.";
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body{
background-image: url(alexander-grey-NkQD-RHhbvY-unsplash.jpg);
background-attachment: fixed;
        background-size: cover;

    }
    .card{
        padding: 10px;
        padding-top: 20px;
        background-image: url(alexander-grey-NkQD-RHhbvY-unsplash.jpg);
        backdrop-filter: blur(15px);
      
    }
    label
    {
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
       .backnw:hover
        {
text-decoration: none;
color: white;
        }

        i{
            color: white;
        }
</style>
</head>
<body>
<a href="login.php" class='backnw'><i class="fa-solid fa-arrow-left"></i> &nbsp; BACK</a>
 <div class="col-lg-6 m-auto">


 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header bg-primary">
 <h1 class="text-white text-center">  Add New</h1>
 </div><br>

 <label> NAME: </label>
 <input type="text" name="Name" class="form-control"> <br>

 <label> GST_no: </label>
 <input type="text" name="GST_no" class="form-control"> <br>

 <label> PHONE: </label>
 <input type="text" name="Phone" class="form-control"> <br>

 <label> Address: </label>
 <input type="text" name="Address" class="form-control"><br>

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