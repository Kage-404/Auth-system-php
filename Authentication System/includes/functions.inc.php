<?php
    function emptyInputSignup($name, $email, $username, $password, $passwordRepeat) {
        if (empty($name) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
            // var_dump($name, $email, $username, $password, $passwordRepeat);
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    function invalidUsername($username) {
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    function invalidEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    function passwordMatch($password, $passwordRepeat) {
        if ($password !== $passwordRepeat) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    function userExists($conn, $username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtFailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData);
    
        mysqli_stmt_close($stmt);
    
        return $row ? $row : false;
    }
    

    function createUser($conn, $name, $email, $username, $password) {
        $sql = "INSERT INTO users(fullname, email, username, password) VALUES(?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtFailed");
            exit();
        }
    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashed_password);
        
        if (!mysqli_stmt_execute($stmt)) {
            header("location: ../signup.php?error=insertFailed");
            exit();
        }
    
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
        exit();
    }

    function emptyInputLogin($username, $password) {
        $result = true;
        if (empty($username) || empty($password)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    function loginUser($conn, $username, $password) {
        $user_exists = userExists($conn, $username, $username);

        if ($user_exists === false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }

        $password_hashed = $user_exists["password"];
        $check_password = password_verify($password, $password_hashed);

        if ($check_password === false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }
        else if ($check_password === true) {
            session_start();
            $_SESSION["userid"] = $user_exists["user_id"];
            $_SESSION["username"] = $user_exists["username"];
            header("location: ../index.php");
            exit();
        }
    }