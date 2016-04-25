<?php

// check if submit is pressed
if(isset($_POST['register'])) {
    // check if firstname is empty, store in var when not
    if (empty($_POST['firstname'])){
        $firstname_empty_error = "Vul uw voornaam in";
    }
    else {
        $firstname = $_POST['firstname'];
    }
    // check if lastname is empty, store in var when not
    if(empty($_POST['lastname'])) {
        $lastname_empty_error = "Vul uw achternaam in";
    }
    else {
        $lastname = $_POST['lastname'];
    }
    // check if birthdate is empty, store in var when not
    if (empty($_POST['birthdate'])) {
        $birthdate_empty_error = "Vul uw geboortedatum in";
    }
    else {
        $birthdate = htmlspecialchars($_POST['birthdate']);
    }
    // check if adress is empty, store in var when not
    if (empty($_POST['adress'])) {
        $adress_empty_error = "Vul uw adres in";
    }
    else {
        $adress = htmlspecialchars($_POST['adress']);
    }
    // check if postcode is empty, store in var when not
    if(empty($_POST['postcode'])) {
        $postcode_empty_error = "Vul uw postcode in";
    }
    else {
        $postcode = htmlspecialchars($_POST['postcode']);
    }
    // check if city is empty, store in var when not
    if(empty($_POST['city'])) {
        $city_empty_error = "Vul uw woonplaats in";
    }
    else {
        $city = htmlspecialchars($_POST['city']);
    }
    // check if email is empty
    if(empty($_POST['email'])) {
        $email_empty_error = "Vul uw email in";
    }
    else {
        // check in database if email is already used
        $email_check = ("SELECT * FROM users WHERE email = '" . $_POST['email'] . "' ");
        // database connenct
        $db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');
        // check if query is succeed
        if($result = mysqli_query($db,$email_check)){
            // store in var when there are no rows, error when not
            if (mysqli_num_rows($result) == null) {
                $email = htmlspecialchars($_POST['email']);
            }
            else {
                $email_error = "Deze email is al in gebruik";
                $_POST['email'] = '';
            }
        }
    }
    // check if both passwords are empty, when not store first password
    if(!empty($_POST['password']) || !empty($_POST['passwordConfirm'])) {
        $password = htmlspecialchars($_POST['password']);
        // check if the two passwords are not the samen, when they are store the second password also.
        if ($_POST['password'] != $_POST['passwordConfirm']) {
            //$password = htmlspecialchars($_POST['password']);
            $password_error = "Uw wachtwoord komt niet overeen.";
            $_POST['passwordConfirm'] = '';
        } else {
            $password_confirm = htmlspecialchars($_POST['passwordConfirm']);
        }
    }
    else {
        $password_error = "Vul uw wachtwoord tweemaal in";
    }
    // check if phone is empty, error when it is
    if(empty($_POST['phone'])) {
        $phone_empty_error = "Vul uw telefoonummer in";
    }
    else {
        // check if phone has 10 numbers
        if(strlen($_POST['phone']) < 10 || strlen($_POST['phone']) > 10){
            $phone_error = "Voer een geldig telefoonnummer in";
            $_POST['phone'] = "";
        }
        else {
            // check if phone has only numbers, stores in var when it is.
            if(is_numeric($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            else {
                $phone_error = "Voer een geldig telefoonnummer in";
            }
        }
    }

    // check is all variables are isset
    if(isset($firstname) && isset($lastname) && isset($email) && isset($adress) && isset($postcode) && isset($city) && isset($phone)
        && isset($password) && isset($password_confirm) && isset($birthdate)) {
        // connenct the database
        $db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');
        // change password to md5
        $password = md5($_POST['password']);

        // check if newletter is isset
        if($newsletter = isset($_POST['newsletter'])) {
            $newsletter = "Ja";
        }
        else {
            $newsletter =  "Nee";
        }
        // insert all data form user to database
        $sql = "INSERT INTO users" .
            "(Firstname, Lastname, Birthdate, Adress, Postcode, City, Email, Password, Phone, Newsletter, Admin)" .
            "VALUES ('$firstname', '$lastname', '$birthdate', '$adress', '$postcode', '$city', '$email', '$password','" . $phone . "', '$newsletter','0')";

        // check if query had succeed, go to other page when it is
        $result = mysqli_query($db, $sql);
        // close the database
        mysqli_close($db);
    }

    // check if clear button is pressed
    if(isset($_POST['clear'])) {
        $firstname = "";
        $lastname = "";
        $birthdate = '';
        $email = "";
        $adress = '';
        $postcode = '';
        $city = '';
        $password = "";
        $password_Confirm = "";
        $phone = "";
    }
}
