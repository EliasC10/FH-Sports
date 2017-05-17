<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <title>Fhsports</title>

    <div class= "Banner">
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
    }?>
</head>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
             Idee und Umsetzung von Elias Cia -->