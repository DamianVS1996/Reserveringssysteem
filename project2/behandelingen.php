<?php
$logout = '';
$login ='';
include("login_session.php");
include("check_login.php");

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
    <link rel="stylesheet" href="css/project2.css"/>
    <link rel="stylesheet" href="css/behandeling.css"/>
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
                <p>Alleen op di en woe</p>
            </div>
            <div>
                <a href="afspraak_maken.php"><img src="bestanden/agenda1.png"></a>
            </div>
        </div>
    </header>
    <div id="container2">
        <main>
            <div id="menu_title">
                <h2>Behandelingen</h2>
            </div>
            <div class="container3">
                <div class="treatment">
                <div class="text">
                    <h2>Hievoor kunt u één online afspraak maken</h2>
                </div>
                <table>
                    <tr><th></th><th>Prijs</th><th>65+</th><th>Tijdsduur</th></tr>
                    <tr><th>Heren</th></tr>
                    <tr><td>Knippen</td><td>€21,00</td><td>€18,50</td><td>30min</td></tr>
                    <tr><td>Knippen wassen drogen</td><td>€23,50</td><td>€21,76</td><td>35min</td></tr>
                    <tr><td>Knippen dunhaar/tondeuse</td><td>€19,50</td><td>€18,50</td><td>20min</td></tr>
                    <tr><td>Knippen achterkant</td><td>€13,50</td><td>€13,50</td><td>20min</td></tr>
                    <tr><td>Baard trimmen</td><td>€6,00</td><td>€6,00</td><td>5min</td></tr>
                    <tr><th>Dames</th></tr>
                    <tr><td>Knippen</td><td>€22,50</td><td>€20,00</td><td>30min</td></tr>
                    <tr><td>Knippen wassen drogen</td><td>€26,50</td><td>€24,00</td><td>35min</td></tr>
                    <tr><td>Knippen wassen föhnen k</td><td>€31,50</td><td>€29,00</td><td>40min</td></tr>
                    <tr><td>Knippen wassen föhnen h/l</td><td>€34,50</td><td>€31,50</td><td>45min</td></tr>
                    <tr><td>Knippen wassen föhnen l/h</td><td>€35,00</td><td>€32,50</td><td>45min</td></tr>
                    <tr><td>Wassen watergolf</td><td>€22,50</td><td>€20,00</td><td>30min</td></tr>
                    <tr><td>Wassen watergolf langhaar</td><td>€24,50</td><td>€22,00</td><td>45min</td></tr>
                    <tr><td>Wassen föhnen korthaar</td><td>€22,50</td><td>€20,00</td><td>30min</td></tr>
                    <tr><td>Wassen föhnen langhaar</td><td>€24,50</td><td>€22,00</td><td>40min</td></tr>
                    <tr><td>Wassen drogen</td><td>€12,50</td><td>€12,50</td><td>20min</td></tr>
                    <tr><td>Knippen model föhnen</td><td>€31,00</td><td>€31,00</td><td>40min</td></tr>
                    <tr><td>Pony knippen</td><td>€8,50</td><td>€8,50</td><td>5min</td></tr>
                    <tr><th>Kinderen</th></tr>
                    <tr><td>t/m 3 jaar </td><td>€12,50</td><td></td><td>30min</td></tr>
                    <tr><td>t/m 15 jaar </td><td>€17,00</td><td></td><td>30min</td></tr>
                    <tr><th>Studenten 16+</th></tr>
                    <tr><td>Jongens </td><td>€20,00</td><td></td><td>30min</td></tr>
                    <tr><td>Meisjes </td><td>€21,50</td><td></td><td>30min</td></tr>
                    <tr><th>Overig</th></tr>
                    <tr><td>Alleen uitdunnen</td><td>€10,00</td><td></td><td>15min</td></tr>
                    <tr><td>Uitdunnen & contouren</td><td>€10,00</td><td></td><td>15min</td></tr>
                    <tr><td>Trouw kapsel icl proef k </td><td>€75,00</td><td></td><td>1,5uur</td></tr>
                    <tr><td>Trouw kapsel icl proef h/l </td><td>€125,00</td><td></td><td>1,5uur</td></tr>
                    <tr><td>Trouw kapsel icl proef l/h </td><td>€125,00</td><td></td><td>2uur</td></tr>
                    <tr><td>Invlechten vanaf</td><td>€25,00</td><td></td><td>45min</td></tr>
                </table>
                </div>
                <div class="treatment2">
                    <div class="text">
                        <h2>Hiervoor kunt u <span>geen</span> online afspraak maken </h2>
                    </div>
                    <table>
                    <tr><th></th><th>Prijs</th><th>65+</th><th>Tijdsduur</th></tr>
                    <tr><th>Kleuren</th></tr>
                    <tr><td>Verven korthaar</td><td>€35,00</td><td></td><td>30min</td></tr>
                    <tr><td>Verven langhaar</td><td>€40,00</td><td></td><td>35min</td></tr>
                    <tr><td>Spoeling korthaar</td><td>€25,00</td><td></td><td>30min</td></tr>
                    <tr><td>Spoeling langhaar</td><td>€32,50</td><td></td><td>35min</td></tr>
                    <tr><td>Spoeling mannen</td><td>€21,50</td><td></td><td>30min</td></tr>
                    <tr><td>Coupesolei korthaar</td><td>€30,00</td><td></td><td>45min</td></tr>
                    <tr><td>Coupesolei langhaar</td><td>€60,00</td><td></td><td>45min</td></tr>
                    <tr><td>Colorsolei korthaar</td><td>€35,00</td><td></td><td>45min</td></tr>
                    <tr><td>Colorsolei langhaar</td><td>€45,00</td><td></td><td>45min</td></tr>
                    <tr><td>Folies middenbaan</td><td>€22,50</td><td></td><td>25min</td></tr>
                    <tr><td>Folies scalp</td><td>€27,50</td><td></td><td>30min</td></tr>
                    <tr><td>Folies t/m 5</td><td>€7,50</td><td></td><td>15min</td></tr>
                    <tr><td>Folies 5 tm/ 10</td><td>€12,50</td><td></td><td>20min</td></tr>
                    <tr><td>Folies 10 t/m 15</td><td>€17,50</td><td></td><td>20min</td></tr>
                    <tr><td>Blondeer "knijp"</td><td>€22,50</td><td></td><td>15min</td></tr>
                    <tr><td>Toeslag per tube</td><td>€12,50</td><td></td><td></td></tr>
                    <tr><th>Permanent</th></tr>
                    <tr><td>Korthaar </td><td>€66,00</td><td>€61,00</td><td>45min</td></tr>
                    <tr><td>Halflang </td><td>€75,00</td><td>€70,00</td><td>45min</td></tr>
                    <tr><td>Langhaar </td><td>€90,00</td><td>€85,00</td><td>45min</td></tr>
                    <tr><td>Deel permanent </td><td>€60,00</td><td>€55,00</td><td>35min</td></tr>
                    </table>
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
    