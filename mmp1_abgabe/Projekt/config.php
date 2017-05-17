<?php

if ($_SERVER['HTTP_HOST'] == 'users.multimediatechnology.at') {
    $DB_NAME = "fhs39917_mmp1";
    $DB_USER = "fhs39917";
    $DB_PASS = "N3sgdi";
    $DSN     = "pgsql:dbname=$DB_NAME;host=localhost";
} else {
    $DB_NAME = "postgres";
    $DB_USER = "postgres";
    $DB_PASS = "password";
    $DSN     = "pgsql:dbname=$DB_NAME;host=localhost";}
?>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
der Fachhochschule Salzburg, Studiengang Multimediatechnology.
Idee und Umsetzung von Elias Cia -->