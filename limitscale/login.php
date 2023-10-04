<?php

$email_error = "";
$password_error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];


    $conn = mysqli_connect("localhost", "root", "", "taskdata");

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to retrieve user data by email
    $sql = "SELECT * FROM limitscale WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if a matching user was found
    if (mysqli_num_rows($result) == 1) {
    
        $user = mysqli_fetch_assoc($result);

     
        if ($password === $user['password']) {
      
            session_start();
            $_SESSION['user_email'] = $email;
         
            header("Location: welcome.html");
            exit();
        } else {
           
            $password_error = "Invalid password. Please try again.";
        }
    } else {
  
        $email_error = "Email not found.";
    }


    mysqli_close($conn);
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 400px;
            height: 450px;
            margin: 100px;
        }
        .f-pass {
            margin-left: 110px;
        }
        form {
            width: 350px;
        }
        .signup {
            margin-left: 25px;
        }
        h2 {
            text-align: center;
            margin: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            LOGIN FORM
        </div>
        <div class="card-body">
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                   
                    <div class="text-danger"><?php echo $email_error; ?></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    
                    <div class="text-danger"><?php echo $password_error; ?></div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>

                <a class="f-pass" href="password-reset.html">Forget password</a>
                <br>
                <br>

                <p>If you are a New user ? <a class="signup" href="index.html">sign up here</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
