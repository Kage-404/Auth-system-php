<?php
    if (isset($_POST["submit"])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        if (!emptyInputLogin($username, $password) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        loginUser($conn, $username, $password);
    } else {
        header("location: ../login.php");
        exit();
    }
