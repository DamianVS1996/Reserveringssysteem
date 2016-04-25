<?php

// database connenct
$db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');

// check if submit is pressed
if(isset($_POST['submit'])) {
    if($_POST['search_subject'] == ''){
        $error =  "Voer iets in om naar te zoeken";
    }
    // check if input is empty
    if (empty($_POST['search'])) {
        $error =  "Voer iets in om naar te zoeken";
    }
    else {

        $search_subject = $_POST['search_subject'];
        $search = $_POST['search'];

        // connect database

        // check if select box = 'users'
        if ($search_subject == "users") {
            // select users thats have the value of the search button
            $user_sql = ("select * from users where firstname = '" . $search . "' OR
            lastname = '" . $search . "' OR
            postcode = '" . $search . "'OR
            city = '" . $search . "' OR
            adress = '" . $search . "' OR
            newsletter = '" . $search . "' OR
            email = '" . $search . "' OR
            phone = '" . $search . "'");
            // check if query got a result, message when not
            if ($result_user = mysqli_query($db, $user_sql)) {
                $num_rows = mysqli_num_rows($result_user);
                // check if number of rows are higher than 0, message when not
                if($num_rows > 0) {
                    while ($row_users = mysqli_fetch_assoc($result_user)) {
                      $users[] = $row_users;
                    }
                }
                else {
                    $no_result = "Er zijn geen resultaten gevonden";
                }
            }
        }
        // check if select box = 'appointments'
        if ($search_subject == "appointments") {
            // select appointments that have the value of the search button
            $appointment_sql = ("select * from appointments where appointment_id = '" . $search . "'
                    OR appointments.email = '" . $search . "'
                    OR treatment_id = '" . $search . "'
                    OR time = '" . $search . "'
                    OR date = '" . $search . "' ");
            // check if query got a result, message when not
            if ($result_appointment = mysqli_query($db, $appointment_sql)) {
                $num_rows = mysqli_num_rows($result_appointment);
                // check if number of rows are higher than 0, message when not
                if($num_rows > 0) {
                    while ($row_appointments = mysqli_fetch_assoc($result_appointment)) {
                        $row_appointments['time'] = date('H:i', strtotime($row_appointments['time']));
                        $row_appointments['date'] = date('l, d M Y', strtotime($row_appointments['date']));
                        $appointments[] = $row_appointments;
                    }
                }
                else {
                    $no_result = "Er zijn geen resulaten gevonden";
                }
            }
        }
        // check if select box = 'treatments'
        if($search_subject == "treatments") {
            //  select treatments that have the value of the search button
            $treatment_sql = ("select * from treatments where treatment_id =  '" . $search . "'
                    OR treatment_name LIKE '%" . $search . "%'
                    OR price = '" . $search . "'
                    OR duration = '" . $search . "' ");

            // check if query got a result, message when not
            if ($result_treatment = mysqli_query($db, $treatment_sql)) {
                $num_rows = mysqli_num_rows($result_treatment);
                if ($num_rows > 0) {
                    while ($row_treatments = mysqli_fetch_assoc($result_treatment)) {
                        $row_treatments['duration'] = date('G:i', strtotime($row_treatments['duration']));
                        $treatments[] = $row_treatments;
                    }
                }
                else {
                    $no_result = "Er zijn geen resulaten gevonden";
                }
            }
        }
    }
    mysqli_close($db);
}
