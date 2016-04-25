<?php

include('login_session.php');
include('check_login.php');

// check if user is logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

// check if user is admin
if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include('search.php');

$search_subject = '';

// Select all appointments except before current date
$sql = ("select * from appointments,users,treatments
          WHERE users.email = appointments.email AND treatments.treatment_id = appointments.treatment_id AND date >= CURRENT_DATE
          ORDER BY date, time ASC");
// database connect
$db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');
// check if there are appointments, message when not
if($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_assoc($result)) {
        $row['time'] = date('H:i', strtotime($row['time']));
        $row['date'] = date(' d M Y', strtotime($row['date']));
        $all_appointments[] = $row;
    }
}
else {
    $no_appointments = "Er zijn geen afspraken";
}
// close database
mysqli_close($db);
?>
<!doctype html>
<html>
<head>
    <title></title>
    <meta name="description" content="text"/>
    <meta charset="utf-8"/>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/admin.css"/>
</head>
<body>
<div class="container">
    <div class="menu">
        <nav>
            <li>Admin</li>
            <?php echo $logout ?>
        </nav>
         <form method="post">
             <label for="search_on">Zoeken op:</label>
             <select id="search_on" name="search_subject" class="search_subject">
                 <option value="">Kies een onderwerp</option>
                 <option value="users"<?php if($search_subject == "users") echo 'selected="selected"'?>>Gebruikers</option>
                 <option value="appointments" <?php if($search_subject == "appointments") echo 'selected="selected"'?>>Afspraken</option>
                 <option value="treatments" <?php if($search_subject == "treatments") echo 'selected="selected"' ?>>Behandelingen</option>
             </select>
             <label for="search_on">Zoeken naar:</label>
             <input id="search_on" type="search" name="search">
             <input type="submit" name="submit" value="Zoeken">
         </form>
    </div>
    <div class="container2">
        <div class="appointments">
            <table>
                <?php if(isset($all_appointments)) { ?>
                <tr>
                    <th>Naam</th>
                    <th>Behandelingsnaam</th>
                    <th>Datum</th>
                    <th>Tijd</th>
                </tr>
                <?php foreach($all_appointments as $appment) {?>
                    <tr>
                        <td><?= $appment['Firstname'] . ' ' . $appment['Lastname']?></td>
                        <td><?= $appment['treatment_name']?></td>
                        <td><?= $appment['date']?></td>
                        <td><?= $appment['time']?></td>
                    </tr>
                <?php }} if(isset($no_appointments)) { ?>
                    <tr><td><?= $no_appointments ?></td></tr>
                 <?php }?>
            </table>
        </div>
        <div class="search_result">
            <span><?php if(isset($no_result)) { echo $no_result; } ?></span>
            <span><?php if(isset($error)) { echo $error; } ?></span>
            <table>
                <?php if(isset($users)) {  ?>
                <tr>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Adres</th>
                    <th>Postcode</th>
                    <th>Woonplaats</th>
                    <th>Email</th>
                    <th>Telefoonnummer</th>
                    <th>Nieuwsbrief</th>
                </tr>
                <?php foreach($users as $user){ ?>
                <tr>
                    <td><?= $user['Firstname']?></td>
                    <td><?= $user['Lastname']?></td>
                    <td><?= $user['Adress']?></td>
                    <td><?= $user['Postcode']?></td>
                    <td><?= $user['City']?></td>
                    <td><?= $user['Email']?></td>
                    <td><?= $user['Phone']?></td>
                    <td><?= $user['Newsletter']?></td>
                </tr>
            <?php  } } if(isset($appointments)) { ?>
                <tr>
                    <th>Email</th>
                    <th>Afspraaknummer</th>
                    <th>Behandelingsnummer</th>
                    <th>Datum</th>
                    <th>Tijd</th>
                </tr>
               <?php foreach($appointments as $appointment) {?>
                <tr>
                    <td><?= $appointment['email'] ?></td>
                    <td><?= $appointment['appointment_id'] ?></td>
                    <td><?= $appointment['treatment_id'] ?></td>
                    <td><?= $appointment['date'] ?></td>
                    <td><?= $appointment['time'] ?></td>
                </tr>
                <?php  } } if(isset($treatments)) { ?>
                <tr>
                    <th>Behandelingsnummer</th>
                    <th>Behandelingsnaam</th>
                    <th>Prijs</th>
                    <th>Prijs 65+</th>
                    <th>Tijdsduur</th>
                </tr>
                <?php foreach($treatments as $treatment) {?>
                <tr>
                    <td><?= $treatment['treatment_id'] ?></td>
                    <td><?= $treatment['treatment_name'] ?></td>
                    <td>€<?= $treatment['price'] ?></td>
                    <td>€<?= $treatment['price65+'] ?></td>
                    <td><?= $treatment['duration'] ?></td>
                </tr>
                <?php  } } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
    