<?php

require_once 'connection.php';


$username = $password = "";
$username_err = $password_err = $login_err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    login($username, $password, $conn);
}

function login($username, $password, $conn)
{
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id_user, username, password, role FROM users WHERE username = ? AND password = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = $password;
            // echo $param_password;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                mysqli_stmt_bind_result($stmt, $id_user, $username, $password, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        $_SESSION["log"] = true;
                        $_SESSION["id_user"] = $id_user;  
                        $_SESSION["username"] = $username;
                        if ($role == "admin") {
                            $_SESSION['isAdmin'] = TRUE;
                            redirect('/pages/admin');
                        } else {
                            $_SESSION['isUser'] = TRUE;
                            redirect('/pages/user');
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                    $_SESSION['login_err'] = $login_err;
                    redirect('/');
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    } else{
        $login_err = "Invalid username or password.";
        $_SESSION['login_err'] = $login_err;
        redirect('/');
    }
}
