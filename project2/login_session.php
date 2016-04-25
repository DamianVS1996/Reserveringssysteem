<?php
// database connect
$db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');
session_start();

$login_user = '';

// check if loggin in is isset
if (isset($_SESSION['logged_in'])) {
    $user_check = $_SESSION['user'];
    // select the name from the user
    $get_user = mysqli_query($db, "select * from users where email='" . $_SESSION['user'] . "'");
    $row_user = mysqli_fetch_assoc($get_user);
    $login_user = "<li class='profileName'><a href='account.php'>" . $row_user['Firstname'] . " " . $row_user['Lastname'] . "</a></li>";

    // usernames are not isset go to index
    if (!isset($login_user)) {
        mysqli_close($db);
        header('Location: index.php');
        exit();
    }

}