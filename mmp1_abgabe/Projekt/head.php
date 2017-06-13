<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amaranth|Lato" rel="stylesheet">
    <link href="sportstyle.css" rel="stylesheet">
    <title>Fhsports</title>

    <div class= "Banner">
        <div class="chat">
            <a href="pusher-realtime-chat-widget/src/chat.html">LiveChat</a>
        </div>
        <a href="index.php"><img id="Banner" src="pictures/Head.jpg" alt="Header"></a>
    </div>

    <?php
    include "functions.php";
    include "ldap.php";

    try {
        $username = $_SERVER['AUTHENTICATE_UID'];
        list($name, $email)= name_and_email_from_ldap( $username );
    } catch (Exception $e) {
        echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
        exit;
    }

    ?>
</head>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
             Idee und Umsetzung von Elias Cia -->