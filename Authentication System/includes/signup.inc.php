<?php
    if (isset($_POST["submit"])) {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $passwordRepeat = trim($_POST["passwordRepeat"]);

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        if (!emptyInputSignup($name, $email, $username, $password, $passwordRepeat) !== false) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }

        if (invalidUsername($username) !== false) {
            header("location: ../signup.php?error=invalidusername");
            exit();
        }
        
        if (invalidEmail($email) !== false) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
        
        if (!passwordMatch($password, $passwordRepeat) !== false) {
            header("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }
        
        if (userExists($conn, $username, $email) !== false) {
            header("location: ../signup.php?error=usernametaken");
            exit();
        }

        createUSer($conn, $name, $email, $username, $password);

    } else {
        header("location: ../signup.php");
    }