<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Authentication System</title>
</head>
<body>
    
    <nav>
        <div class="wrapper">
            <ul class="nav-links">
                <li><a href='index.php'>Home</a></li>
                <?php 
                    if (isset($_SESSION["userid"])) {
                        echo "<li><a class='btn' href='profile.php'>Profile</a></li>";
                        echo "<li><a class='btn' href='includes/logout.inc.php'>Log Out</a></li>";
                    } else {
                        echo "<li><a class='btn' href='signup.php'>Sign Up</a></li>";
                        echo "<li><a class='btn' href='login.php'>Log In</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>