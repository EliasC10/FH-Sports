<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amaranth|Lato" rel="stylesheet">
    <link rel="stylesheet" href="indexstyle.css">

    <title>Fhsports | Home</title>

    <?php
    include "functions.php";
    ini_set('error_reporting', E_ALL);

    $sth = $dbh->query("SELECT * FROM sports ORDER BY sport_id ASC");
    $sports = $sth->fetchAll();?>

    <div class= "Banner">
        <div class="chat">
            <a href="pusher-realtime-chat-widget/src/chat.html">LiveChat</a>
        </div>
        <img id="Banner" src="pictures/Head.jpg" alt="Header">
    </div>



</head>


<body>
    <div class="Sports">
        <?php foreach($sports as $sport) : ?>
        <div class="item" id="<?php echo $sport->sport ?>"
             style=
                    "background: url('pictures/<?php echo $sport->picture?>') no-repeat;
                     background-size:100%">
             <a href="sport.php?sport_id=<?php echo $sport->sport_id?>"><?php echo $sport->sport?></a>
        </div>

        <?php endforeach; ?>
        <div id="newsport">
            <a id="entry" href="new_sport.php">Sportart hinzufügen</a>
        </div>
        <?php include "footer.php";?>
    </div>





</body>
</html>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
             Idee und Umsetzung von Elias Cia -->