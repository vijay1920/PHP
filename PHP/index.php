<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="pngwing.com.png" class="imagev" alt="">
    <div class="form">
    
    <form action="login.php" method="post">
        <h1>VM TEX</h1>
        <?php
    // Check if there is an error message stored in the session
    session_start();
    if (isset($_SESSION['login_error'])) {
        echo '<p  class="error-message">' . $_SESSION['login_error'] . '</p>';
        unset($_SESSION['login_error']); // Remove the error message from the session after displaying it
    }
    ?>
     <div class="inpu">
        <input type="text" placeholder="Admin ID" name="username">
        <input type="password" placeholder="password" name="password">
        </div>
        <button type="submit">Login</button>
    </form>
    </div>
</body>
</html>