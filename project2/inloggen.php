<?php

include('login_session.php');
include('check_login.php');

// check if user is logged in
if(isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

// global vars
$error = '';
$email = '';
$login_session = '';

// check is submit button is pressed
if(isset($_POST['login'])) {
    // check if email or password are empty
    if(empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Vul uw inloggegevens in";
    }
    else {
        // put posts in variables
        $email = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']);
        require_once('config.php');
        // check if database can connect
        if(mysqli_connect_error())
        {
            echo 'DATABASE ERROR: '.mysqli_connect_error();
        }
        // check if email and password match in database
        $login_query = mysqli_query($db, "SELECT * FROM Users WHERE Email = '" . $email . "' AND Password = '" . $password . "'");
        $user_type = mysqli_fetch_assoc($login_query);
        $row = mysqli_num_rows($login_query);

        // check if result is one row
        if($row == 1) {
            //check if person is an admin
            if($user_type['Admin'] == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['admin'] = true;
                $_SESSION['logged_in'] = true;
                header('Location: admin.php');
                exit();
            }
            elseif($user_type['Admin'] == 0) {
                // put email in a session en give logged in a true
                $_SESSION['user'] = $email;
                $_SESSION['logged_in'] = true;
                header("Location: index.php");
                exit();
            }
        }
        // error if email and password don't match
        else {
            $error = "Uw inloggegevens zijn niet juist";
        }
        mysqli_close($db);
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
    <link rel="stylesheet" href="css/project2.css"/>
    <link rel="stylesheet" href="css/inloggen.css"/>
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
                <?php echo $login . $logout ?>
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
                <h2>Inloggen</h2>
            </div>
            <div id="form">
                <form method="post">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" class="input-field" value="<?php echo $email ?>">
                        <label for="password">Wachtwoord</label>
                        <input id="password" type="password" name="password" class="input-field">
                        <span class="error"><?php echo $error ?></span>
                        <input type="submit" name="login" value="Login" id="login">
                </form>
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
    