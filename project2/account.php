<?php

// include files
require_once('config.php');
include('login_session.php');
include('check_login.php');

// vars
$error = '';
$succes = '';
$password_error = '';
$password_succes = '';


// check if user is logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}
// include files for update
include('updateAccount.php');
include('updatePassword.php');

// get al appointment of a user from database
$appointments_sql = "select *
from appointments
join treatments on treatments.treatment_id
WHERE appointments.email = '" . $_SESSION['user'] . "' AND treatments.treatment_id = appointments.treatment_id AND date >= CURRENT_DATE
GROUP BY appointments.appointment_id
ORDER BY date ASC";

//check if the query have a result
if($appointment_result = mysqli_query($db, $appointments_sql)) {
    while($row = mysqli_fetch_assoc($appointment_result)) {
        $row['time'] = date('H:i', strtotime($row['time']));
        $row['duration'] = date('G:i', strtotime($row['duration']));
        $row['date'] = date('l, d M Y', strtotime($row['date']));
        $appointments[] = $row;
    }
}
?>
<!doctype html>
<html>
<head>
    <title></title>
    <meta name="description" content="text"/>
    <meta charset="utf-8"/>
    <link href='http://fonts.googleapis.com/css?family=Rouge+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="css/project2.css"/>
</head>
<body>
<div id="container">
    <nav>
        <div id="left">
            <ul>
                <li><a href="index.php">Home </a></li>
                <li><a href="over_ons.php">Over ons </a></li>
                <li><a href="behandelingen.php">Behandelingen </a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div id="title">
            <a href="index.php"><h1>Het Barbersjoppie</h1></a>
        </div>
        <div id="right">
            <ul>
                <?php echo $login_user ?>
                <?php echo $logout . $login ?>
                <?php echo $register ?>
            </ul>
        </div>
    </nav>
    <header>
        <div id="background"></div>
        <div id="afspraak">
            <div>
                <h2>Maak nu uw afspraak online!</h2>
                <p>Klik op de agenda</p>
            </div>
            <div>
                <a href="afspraak_maken.php"><img src="bestanden/agenda1.png"></a>
            </div>
        </div>
    </header>
    <div id="container2">
        <main>
            <div id="menu_title">
                <h2>Mijn Account</h2>
            </div>
            <div id="booking">
                <h3>Mijn afspraken</h3>
                <div>
                    <table>
                        <?php if(isset($appointments)) {
                        foreach($appointments as $appointment){ ?>
                                <tr><td>Behandeling:</td><td><?= $appointment['treatment_name']; ?></td></tr>
                                <tr><td>Datum:</td><td><?= $appointment['date']; ?></td></tr>
                                <tr><td>Tijd:</td><td><?= $appointment['time']; ?></td></tr>
                                <tr><td>Tijdsduur:</td><td><?= $appointment['duration']; ?></td></tr>
                                <tr><td>Prijs:</td><td><?= '€'. $appointment['price']; ?></td></tr>
                                <tr><td><a href="afspraak_verwijderen.php?id=<?= $appointment['appointment_id']?>">Afspraak annuleren</a></td></tr>
                    <?php  }
                        } ?>
                    </table>
                </div>
            </div>
            <div id="change">
                <div class="change_account">
                    <h3>Account wijzingen</h3>
                    <form method="post">
                            <div class="element">
                                <span class="succes_message"><?php echo $succes ?></span>
                            </div>
                            <div class="element">
                                <span class="error_message"><?php echo $error ?></span>
                            </div>
                            <div class="element">
                                <label for="firstname">Voornaam:</label>
                                <input id="firstname" type="text" class="input-field" name="firstname" autofocus="" value="<?php echo $row_user['Firstname'] ?>" />
                            </div>
                            <div class="element">
                                <label for="lastname">Achternaam:</label>
                                <input id="lastname" type="text" class="input-field" name="lastname" value="<?php echo $row_user['Lastname'] ?>" />
                            </div>
                            <div class="element">
                                <label for="birthdate">Geboortedatum:</label>
                                <input id="birthdate" type="date" class="input-field" name="birthdate" value="<?php echo $row_user['Birthdate'] ?>" />
                            </div>
                            <div class="element">
                                <label for="adress">Adres</label>
                                <input id="adress" type="text" class="input-field" name="adress" value="<?php echo $row_user['Adress'] ?>" />
                            </div>
                            <div class="element">
                                <label for="postcode">Postcode:</label>
                                <input id="postcode" type="text" class="input-field" name="postcode" value="<?php echo $row_user['Postcode'] ?>" />
                            </div>
                            <div class="element">
                                <label for="city">Woonplaats:</label>
                                <input id="city" type="text" class="input-field" name="city" value="<?php echo $row_user['City'] ?>" />
                            </div>
                            <div class="element">
                                <label for="email">E-mail:</label>
                                <input id="email" type="email" class="input-field" name="email" value="<?php echo $row_user['Email'] ?>" disabled/>
                            </div>
                            <div class="element">
                                <label for="phone">Telefoonnummer:</label>
                                <input id="phone" type="text" class="input-field" name="phone" value="<?php echo '0' . $row_user['Phone'] ?>" />
                            </div>
                            <div class="element">
                                <span><label for="newsletter">Wilt uw de nieuwsbrief ontvangen?</label></span>
                                <input id="newsletter" type="checkbox" name="newsletter" value="<?php echo $row_user['Newsletter'] ?>" <?php echo ($row_user['Newsletter'] == 'Ja' ? 'checked' : ''); ?> />
                            </div>
                            <span class="error_message"><?php if(isset($change_error)){ echo $change_error; }?></span>
                            <div class="element">
                                <input type="submit" name="change" value="Wijzigen" id="submit">
                            </div>

                    </form>
                </div>
                <div class="change_password">
                    <h3>Wachtwoord wijzingen</h3>
                    <form method="post">
                        <div class="element">
                            <label for="old_password">Oude wachtwoord:</label>
                            <input id="old_password" type="password" class="input-field" name="old_password" />
                        </div>
                        <div class="element">
                            <label for="new_password">Nieuwe wachtwoord:</label>
                            <input id="new_password" type="password" class="input-field" name="new_password" />
                        </div>
                        <div class="element">
                            <label for="confirm_password">Bevestig wachtwoord:</label>
                            <input id="confirm_password" type="password" class="input-field" name="confirm_password" />
                        </div>
                        <div class="element">
                            <span class="error_message"><?php echo $password_error ?></span>
                            <span class="succes_message"><?php echo $password_succes ?></span>
                        </div>
                        <div class="element">
                            <input type="submit" name="pass_change" value="Wijzigen" id="submit">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <aside>
            <div id="openingstijden">
                <h2>Openingstijden</h2>
                <table>
                    <tr>
                        <td>Maandag:</td>
                        <td>13:00-17:00</td>
                    </tr>
                    <tr>
                        <td>Dinsdag:</td>
                        <td>08:30-17:00</td>
                    </tr>
                    <tr>
                        <td>Woensdag:</td>
                        <td>08:30-17:00</td>
                    </tr>
                    <tr>
                        <td>Donderdag:</td>
                        <td>08:30-17:00</td>
                    </tr>
                    <tr>
                        <td>Vrijdag:</td>
                        <td>08:30-17:00</td>
                    </tr>
                    <tr>
                        <td>Zaterdag:</td>
                        <td>08:00-15:00</td>
                    </tr>
                    <tr>
                        <td>Zondag:</td>
                        <td>Gesloten</td>
                    </tr>
                </table>
            </div>
            <h2>Wij zijn hier te vinden!</h2>
            <div id="googleMap"></div>
            <div id="adresGegevens">
                <h2>Adres gegevens</h2>
                <ol>
                    <li>Middenbaan</li>
                    <li>103 2991 CS</li>
                    <li>Barendrecht</li>
                    <li>Tel. 0180-613399</li>
                </ol>
            </div>
        </aside>
    </div>
</div>
<footer>
    <div>
        <ol>
            <li>Middenbaan</li>
            <li>103 2991 CS</li>
            <li>Barendrecht</li>
            <li>Tel. 0180-613399</li>
        </ol>
    </div>
    <div id="social">
        <h3>Volg ons!</h3>
        <h3><a href="http://facebook.com"><img src="bestanden/facebook.png"></a></h3>
    </div>
</footer>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="js/googleMaps.js"></script>

</body>
</html>
    