<?php

require_once("config.php");

if(isset($_POST['change'])) {
    // check if firstname is empty, store in var when not
    if (empty($_POST['firstname'])){
        $change_error = "Vul uw voornaam in";
    }
    else {
        $firstname = $_POST['firstname'];
    }
    // check if lastname is empty, store in var when not
    if(empty($_POST['lastname'])) {
        $change_error = "Vul uw achternaam in";
    }
    else {
        $lastname = $_POST['lastname'];
    }
    // check if birthdate is empty, store in var when not
    if (empty($_POST['birthdate'])) {
        $change_error = "Vul uw geboortedatum in";
    }
    else {
        $birthdate = htmlspecialchars($_POST['birthdate']);
    }
    // check if adress is empty, store in var when not
    if (empty($_POST['adress'])) {
        $change_error = "Vul uw adres in";
    }
    else {
        $adress = htmlspecialchars($_POST['adress']);
    }
    // check if postcode is empty, store in var when not
    if(empty($_POST['postcode'])) {
        $change_error = "Vul uw postcode in";
    }
    else {
        $postcode = htmlspecialchars($_POST['postcode']);
    }
    // check if city is empty, store in var when not
    if(empty($_POST['city'])) {
        $change_error = "Vul uw woonplaats in";
    }
    else {
        $city = htmlspecialchars($_POST['city']);
    }
    if(empty($_POST['phone'])) {
        $change_error = "Vul uw telefoonummer in";
    }
    else {
        // check if phone has 10 numbers
        if(strlen($_POST['phone']) < 10 || strlen($_POST['phone']) > 10){
            $change_error = "Voer een geldig telefoonnummer in";
            $_POST['phone'] = "";
        }
        else {
            $phone = $_POST['phone'];
        }
    }
    // check if password is empty
//    if(empty($_POST['password'])){
//        $change_error = "Vul uw wachtwoord in";
//    }
//    else {
//
//        // get old password from database from user
//        $password_sql = "select password from users where email = '" . $_SESSION['user'] . "'";
//        $password_result = mysqli_query($db, $password_sql);
//        $getPassword = mysqli_fetch_assoc($password_result);
//        // check if old password match, error when not
//        if($getPassword['password'] == md5($_POST['password'])){
//            $password = md5($_POST['password']);
//        }
//        else {
//            $change_error = "Uw wachtwoord was niet juist";
//        }
//    }
    // check if all variables are isset
    if(isset($firstname) && isset($lastname) && isset($adress) && isset($postcode) && isset($city) && isset($phone)
        && isset($birthdate)) {
            // check if newsletter is isset
            if ($newsletter = isset($_POST['newsletter'])) {
                $newsletter = "Ja";
            } else {
                $newsletter = "Nee";
            }
            // get old password;
            // update the dat of the user
            $sql = "UPDATE Users SET  Firstname = '$firstname', Lastname = '$lastname', Birthdate = '$birthdate', Adress = '$adress',
            Postcode = '$postcode', City = '$city', Phone = '$phone', Newsletter = '$newsletter'
            WHERE email = '" . $_SESSION['user'] . "'";
            // check if result is true, error when its not.
            $result = mysqli_query($db, $sql);
            // check if query has succeed
            if ($result === TRUE) {
                $succes = "Uw gegevens zijn succesvol gewijzigd!";
            } else {
                $error = "Er ging iets mis tijdens het wijzingen";
            }

            //refresh the page to refresh the data of the user
            $page = $_SERVER['PHP_SELF'];
            $sec = "2";
            header("Refresh: $sec; url=$page");
        }
}

