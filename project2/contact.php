<?php

// form vars
$name = "";
$email = "";
$subject = "";
$comments = "";
$error = '';

// errors vars
$name_error = "";
$email_error = "";
$subject_error = "";
$comments_error = "";
$succes = "";

$logout = '';
$login ='';
include("login_session.php");
include("check_login.php");

// check if submit is pressed
if(isset($_POST['submit'])) {
    // check if one of the field are empty, send mail when not
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['comments'])) {
        // error when name is empty
        if (empty($_POST['name'])) {
            $name_error = "Vul uw naam in";
        } else {
            $name = htmlspecialchars($_POST['name']);
        }
        // error when email is empty
        if (empty($_POST['email'])) {
            $email_error = "Vul uw email in";
        } else {
            $email = htmlspecialchars($_POST['email']);
        }
        // error when subject is empty
        if (empty($_POST['subject'])) {
            $subject_error = "Vul een onderwerp in";
        } else {
            $subject = htmlspecialchars($_POST['subject']);
        }
        // error when comments is empty
        if (empty($_POST['comments'])) {
            $comments_error = "Vul dit veld in";
        } else {
            $comments = htmlspecialchars($_POST['comments']);
        }
    }
    else {
        $header = "From: '$email'" . "\r\n";;
        // check if mail is succesfully send, error when not.
        if(mail('0879504@hr.nl',$subject,$comments,$header)) {
            $succes = '<div class="succes">' . '<img src="bestanden/vinkje2.png">' . 'Uw vraag is succesvol verzonden.' . '<br>'
                . 'Wij zullen de vraag zo snel mogelijk voor u beantwoorden.' . '</div>';
            $name = "";
            $email = "";
            $subject = "";
            $comments = "";
        }
        else {
            $error = "Er ging iets mis met het verzenden";
        }
    }
}

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
    <meta name="description" content="text"/>
    <meta charset="utf-8"/>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/contact.css"/>
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
                <h2>Contact</h2>
            </div>
            <form method="post">
                    <div>
                        <label for="name">Naam</label>
                        <input type="text" name="name" id="name" class="input-field" value="<?php echo $name ?>"><?php echo "<p>" . $name_error . "</p>"?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="input-field" value="<?php echo $email ?>"><?php echo "<p>" . $email_error . "</p>"?>
                    </div>
                    <div>
                        <label for="subject">Onderwerp</label>
                        <input type="text" name="subject" id="subject" class="input-field" value="<?php echo $subject ?>"><?php echo "<p>" . $subject_error . "</p>" ?>
                        <label for="comments">Opmerkingen</label>
                        <textarea id="comments" name="comments" rows="7" cols="50"><?php echo $comments ?></textarea>
                        <?php echo "<p>" . $comments_error .  "</p>"?>
                        <input type="submit" value="Verzenden" name="submit" id="submit">
                        <?php echo $succes . $error ?>
                    <div>
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
    