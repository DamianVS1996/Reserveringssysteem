<?php

require_once("config.php");

//check is the submit is pressed
if(isset($_POST['pass_change'])) {
    // post the values in vars
    $old_password = ($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check if old password is empty
    if (empty($old_password)) {
        $password_error = "Vul uw oude wachtwoord in";
    }
    //check if new password are the same twice
    if ($new_password != $confirm_password) {
        $password_error = "Bevestig uw nieuwe wachtwoord";
    }

    // select users password
    $password_sql = "select * from users where email = '" . $_SESSION['user'] . "'";
    $password_result = mysqli_query($db, $password_sql);
    $getPassword = mysqli_fetch_assoc($password_result);
    $user_password = $getPassword['Password'];
    // check if old password is the same and new password is the samen with the oteher
    if ($user_password == md5($old_password) && $new_password == $confirm_password) {
        // Update the password
        $sql = "UPDATE users SET  password = '$new_password'
                WHERE email = '" . $_SESSION['user'] . "'";

        $result = mysqli_query($db, $sql);

        // check if query has succeed
        if ($result === TRUE) {
            $password_succes = "Uw wachtwoord is succesvol gewijzigd!";
        }
    }
    else {
        $password_error = "Uw oude wachtwoord was niet juist";
    }
}