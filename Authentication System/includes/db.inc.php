<?php
    $hostname = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $db = "auth";

    $conn = mysqli_connect($hostname, $dbusername, $dbpassword, $db);

    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }