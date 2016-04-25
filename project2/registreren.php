<?php

// inlcude files
require_once('config.php');
include('register.php');
include('login_session.php');
include('check_login.php');

// check if user is logged in
if(isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
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
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/project2.css"/>
    <link rel="stylesheet" href="css/registreren.css"/>
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
                <?php echo $logout . $login?>
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
                <h2>Registreren</h2>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="element">
                        <label for="firstname">Voornaam:</label>
                        <input id="firstname" type="text" class="input-field" name="firstname" autofocus="" value="<?php if(isset($firstname)) { echo $firstname; }?>" />
                        <span class="error">* <?php if(isset($firstname_empty_error)){ echo $firstname_empty_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="lastname">Achternaam:</label>
                        <input id="lastname" type="text" class="input-field" name="lastname" value="<?php if(isset($lastname)) { echo $lastname; }?>" />
                        <span class="error">* <?php if(isset($lastname_empty_error)){ echo $lastname_empty_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="birthdate">Geboortedatum:</label>
                        <input id="birthdate" type="date" class="input-field" name="birthdate" value="<?php if(isset($birthdate)) { echo $birthdate; } ?>" />
                        <span class="error">* <?php if(isset($birthdate_empty_error)){ echo $birthdate_empty_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="adress">Adres:</label>
                        <input id="adress" type="text" class="input-field" name="adress" value="<?php if(isset($adress)) {  echo $adress; } ?>" />
                        <span class="error">* <?php if(isset($adress_empty_error)){ echo $adress_empty_error; }  ?></span>
                    </div>
                    <div class="element">
                        <label for="postcode">Postcode:</label>
                        <input id="postcode" type="text" class="input-field" name="postcode" value="<?php if(isset($postcode)) { echo $postcode; } ?>" />
                        <span class="error">* <?php if(isset($postcode_empty_error)){ echo $postcode_empty_error; } ?></span>
                    </div>
                    <div class="element">
                        <label for="city">Woonplaats:</label>
                        <input id="city" type="text" class="input-field" name="city" value="<?php if(isset($city)) { echo $city; } ?>" />
                        <span class="error">* <?php if(isset($city_empty_error)){ echo $city_empty_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="email">E-mail:</label>
                        <input id="email" type="email" class="input-field" name="email" value="<?php if(isset($email)) { echo $email; } ?>" />
                        <span class="error">* <?php if(isset($email_empty_error)){ echo $email_empty_error; } if(isset($email_error)){ echo $email_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="password">Wachtwoord:</label>
                        <input id="password" type="password" class="input-field" name="password" value="<?php if(isset($password)) { echo $password; } ?>" />
                        <span class="error">* <?php ?></span>
                    </div>
                    <div class="element">
                        <label for="passwordConfirm">Bevestig wachtwoord:</label>
                        <input id="passwordConfirm" type="password" class="input-field" name="passwordConfirm" value="<?php if(isset($password_confirm)) {  echo $password_confirm; }?>" />
                        <span class="error">* <?php if(isset($password_empty_error)){ echo $password_empty_error; } if(isset($password_error)){ echo $password_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="phone">Telefoonnummer:</label>
                        <input id="phone" type="text" class="input-field" name="phone" value="<?php if(isset($phone)) {  echo $phone; }?>" />
                        <span class="error">* <?php if(isset($phone_empty_error)){ echo $phone_empty_error; } if(isset($phone_error)){ echo $phone_error; }?></span>
                    </div>
                    <div class="element">
                        <label for="newsletter">Wilt uw de nieuwsbrief ontvangen?</label>
                        <input id="newsletter" type="checkbox" name="newsletter" value="1">
                    </div>
                    <input type="submit" name="register" value="Registreer" id="register">
                    <input type="submit" name="clear" value="Leegmaken" id="clear">
                    <p>* verplichte velden</p>
            </form>
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
    