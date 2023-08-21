<?php
    // include "connect.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'vmtex';

        $conn = new mysqli($host, $username, $password, $database);

        $sql = "DELETE from `party` WHERE id=$id";
        $conn->query($sql);
    }
    header("location: /Hello/login.php");
    exit;


?>