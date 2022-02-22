<?php

include('dbconn.php');


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add-submit'])){
    add_service($conn);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete-submit'])){
    delete_service($conn);
}

function add_service($conn){
    //echo "ADD SERVICE!";
    session_start();

    $title = $_POST['title'];
    $url = $_POST['link'];

    // REMOVE all illegal characters from a url
    $url = filter_var($url, FILTER_SANITIZE_URL);



    if (empty($title) || empty($url)) {
        // return error if all fields are empty
        header("Location: ../add_service.php?error=emptyfields&title=".$title."&link=".$url);
        exit();
    } else if (!filter_var($url, FILTER_VALIDATE_URL)) {
        // return error invalid email
        header("Location: ../add_service.php?error=invalidlink&title=".$title);
        exit();
    } else {

        $sql = "INSERT INTO services (title, link)
                VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("Location: ../add_service.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $title, $url);
            mysqli_stmt_execute($stmt);
            mysqli_close($conn);

            header("Location: ../add_service.php?add=success");
            exit();
        }
    }
}

function delete_service($conn){
    //echo "DELETE SERVICE!";
    session_start();

    $serviceId = $_POST['serviceId'];
    $title = $_POST['serviceTitle'];
    $titleConfirm = $_POST['titleConfirm'];

    if (empty($titleConfirm)) {
        // return error if all fields are empty
        header("Location: ../delete_service.php?error=emptyfields&serviceId=$serviceId&serviceTitle=$title");
        exit();
    } elseif ($title != $titleConfirm) {
        header("Location: ../delete_service.php?error=nomatch&serviceId=$serviceId&serviceTitle=$title&titleConfirm=$titleConfirm");
        exit();
    } elseif ($title === $titleConfirm) {
        //echo 'ID: ' .$serviceId. ' Title: ' .$title. ' Title Confirm: ' .$titleConfirm;

        $sql = "DELETE FROM `services`
                WHERE id = '$serviceId' and title = ?";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../delete_service.php?error=sqlerror");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "s", $titleConfirm);
            mysqli_stmt_execute($stmt);

            header("Location: ../dashboard.php?delete=success");
            exit();
        }

    }



}

?>
