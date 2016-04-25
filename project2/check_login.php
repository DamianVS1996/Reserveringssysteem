<?php
// global vars
$logout = '';
$login ='';
$register = '';

// check is session is isset show logout button, when not show login and register
if(isset($_SESSION['user'])) {
    $logout = '<li><a href="logout.php">Uitloggen</a></li>';
}
else {
    $login = '<li><a href="inloggen.php">Inloggen</a></li>';
    $register = '<li><a href="registreren.php">Registeren</a></li>';
}
