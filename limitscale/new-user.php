<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($password);


    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit; 
    }

    
    $conn = mysqli_connect("localhost", "root", "", "taskdata");

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO limitscale (email, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        session_start();
        $_SESSION['user_email'] = $email;
        // Redirect to a Welcome Page
        header("Location: welcome.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

