<?php
$db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');

$appointment_id = $_GET['id'];
$sql = ("DELETE from appointments WHERE appointment_id = '". $appointment_id . "'");
if($result = mysqli_query($db,$sql)) {
    $delete_succes = "Uw afspraak is geannulleerd";
    header('Location: account.php');
}
else {
    $delete_error = "Er ging iets mis tijdens het annuleren";
}
