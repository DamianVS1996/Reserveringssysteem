<?php
// include files
include("login_session.php");
include("check_login.php");
require('config.php');

// check if user is logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: inloggen.php");
    exit();
}
// global vars
$error = '';

// database connect
$db = mysqli_connect('studenten.cmi.hro.nl', '0879504', '//', '0879504');

// select all treatments by name
$query = mysqli_query($db, "select treatment_name from treatments");
$set_value = 0;

// select all times to make an appointment
$times_sql = ("select * from appointments_times");
// check if result is true
if ($result = mysqli_query($db, $times_sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['time'] = date('H:i', strtotime($row['time']));
        $times[] = $row;
    }
}

// check is submit button is pressed
if(isset($_POST['submit'])) {
    // check is a treatment is chosen
    if($_POST['treatment'] == ""){
        $error = "Kies uw behandeling";
    }
    else {
        $treatment = $_POST['treatment'];
    }
    // check if a time is empty, store in var when not
    if(empty($_POST['time'])) {
        $error = "Kies uw tijd";
    }
    else {
        $chosen_time = $_POST['time'];
    }

    // get dat and change is to fully name
    $day_check = $_POST['date'];
    $day_check = strtotime($day_check);
    $day_check = date("l", $day_check);
    // check if date is a thuesday or wednesday, error when not
    if ($day_check == 'Tuesday' || $day_check == 'Wednesday') {
        $date = $_POST['date'];
        $sql_appointment = ("select * from appointments where date='$date'");
        if ($result = mysqli_query($db, $sql_appointment)) {
            while ($row_appointment = mysqli_fetch_assoc($result)) {
                $available_time[] = $row_appointment;
            }
        }
        else {
            echo "ging niet geod";
        }
    }
    else {
        $error = "Afspraken kunnen alleen op een dinsdag of woensdag worden gemaakt";

    }
/*
if(isset($date)) {
if (isset($available_time)) {
    foreach ($available_time as $time) {
        $available_times_sql = ("select time from appointments WHERE time != '" . $time['time'] . "'");
        if ($result = mysqli_query($db, $available_times_sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['time'] = date('H:i', strtotime($row['time'])); ?>
                <input type="radio" name="time" id="time" class="available_times" value="<?= $row['time']?>">
                <label for="time"><?= $row['time']?></label>
            <?php }
        }
    }
*/
    // check if date, time and treatment are isset
    if(isset($date) && isset($chosen_time) && isset($treatment)) {
        // insert a appointment to database
        $make_appointment = "INSERT INTO appointments" .
            "(Treatment_id, Email, Date, Time)" .
            "VALUES ('$treatment', '" . $_SESSION['user'] . "','$date','$chosen_time')";
        // check if result is true, when it is send to index.php
        if($result = mysqli_query($db,$make_appointment)) {
            header('Location: index.php');
            exit();
        }
        else {
            echo "er ging iets mis";
        }
    }
}



?>
<!doctype html>
<html>
<head>
    <title></title>
    <meta name="description" content="text"/>
    <meta charset="utf-8"/>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/project2.css"/>
    <link rel="stylesheet" href="css/afspraak.css"/>
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
                <h2>Afspraak maken</h2>
            </div>
            <div>
                <h2 style="margin-top: 20px">Afspraken kunnen alleen op een dinsdag en woensdag worden gemaakt.</h2>
            </div>
            <form method="post" class="make_appointment" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin: 30px 0 0 20px">
                <div class="element">
                    <label for="treatment">Kies uw behandeling:</label>
                    <select id="treatment" name="treatment">
                        <option value="">Kies uw behandeling</option>
                        <?php while($droplist = mysqli_fetch_array($query)){
                        $set_value++;
                        $treatment_name = $droplist['treatment_name'];
                        if($set_value == 1){
                            echo "<optgroup label='Heren'></optgroup>";
                        }
                        if($set_value == 6) {
                            echo "<optgroup label='Dames'></optgroup>";
                        }
                        if($set_value == 18) {
                            echo "<optgroup label='Kinderen'></optgroup>";
                        }
                        if($set_value == 20) {
                            echo "<optgroup label='Studenten 16+'></optgroup>";
                        }
                        if($set_value == 22) {
                            echo "<optgroup label='Overig'></optgroup>";
                        } ?>
                        <option value='<?=$set_value?>'><?= $treatment_name ?></option>
                       <?php } ?>
                    </select>
                </div>
                <div class="element">
                    <label for="date">Kies uw datum:</label>
                    <input id="date" type="date" name="date" value="<?php if(isset($date)) {echo $date; } ?>">
                </div>
                <div class="element">
                    <div class="chooseTime">
                        <span>Kies uw tijd:</span>
                        <div>
                        <?php if(isset($times)) foreach($times as $time) { ?>
                            <input type="radio" name="time" id="times" class="available_times" value="<?= $time['time'] ?>">
                             <label for="times"><?= $time['time'] ?></label>
                         <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="element">
                    <span class="error"><?php echo $error ?></span>
                    <input type="submit" name="submit" value="Afspraak maken" class="submit">
                </div>
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
    