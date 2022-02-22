<?php

include('dbconn.php');


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login-submit'])){
    login($conn);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logout-submit'])){
    logout($conn);
}

function login($conn){

    session_start();

    $userName = $_POST['username'];
    $password = $_POST['pwd'];

    if(empty($userName) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM logins WHERE userName=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['password']);
                if($pwdCheck == false) {
                    header("Location: ../index.php?error=loginerror");
                    exit();
                } else if ($pwdCheck == true) {


                    $_SESSION['userId'] = $row['userId'];
                    $_SESSION['userName'] = $row['userName'];

                    header("Location: ../index.php?login=success");
                    exit();


                } else {
                    header("Location: ../index.php?error=loginerror");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

}

function logout($conn){

    session_start();
    session_unset();
    session_destroy();

    header("Location: ../index.php");

}

?>
