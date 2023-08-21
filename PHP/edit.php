<?php
  include "connect.php";
  $id="";
  $Name="";
  $GST_no="";
  $Phone="";

  $error="";
  $success="";

  if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['id'])){
      header("location:crud100/index.php");
      exit;
    }
    $id = $_GET['id'];
    $sql = "select * from party where id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    while(!$row){
      header("location: /Hello/login.php");
      exit;
    }
    $Name=$row["Name"];
    $GST_no=$row["GST_no"];
    $Phone=$row["Phone"];

  }
  else{
    $id = $_POST["id"];
    $Name=$_POST["Name"];
    $GST_no=$_POST["GST_no"];
    $Phone=$_POST["Phone"];

    $sql = "update party set Name='$Name', GST_no='$GST_no', Phone='$Phone' where id='$id'";
    $result = $conn->query($sql);
    
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body{
background-image: url(cody-chan-1VPoVeKGSWc-unsplash.jpg);
background-attachment: fixed;
        background-size: cover;
}
.card{
  padding: 10px;
        padding-top: 20px;
        background-image: url(alexander-grey-NkQD-RHhbvY-unsplash.jpg);
        backdrop-filter: blur(15px);
        margin-top: 50px;
        flex-wrap: wrap;
      
}
label{
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
</style>
</head>
<body>
<a href='login.php' class='backnw'> <i class="fa-solid fa-arrow-left"></i>  &nbsp;Back</a> 
 <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header bg-warning">
 <h1 class="text-black text-center">  Update Member </h1>
 </div><br>

 <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

 <label> NAME: </label>
 <input type="text" name="Name" value="<?php echo $Name; ?>" class="form-control"> <br>

 <label> EMAIL: </label>
 <input type="text" name="GST_no" value="<?php echo $GST_no; ?>" class="form-control"> <br>

 <label> PHONE: </label>
 <input type="text" name="Phone" value="<?php echo $Phone; ?>" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>