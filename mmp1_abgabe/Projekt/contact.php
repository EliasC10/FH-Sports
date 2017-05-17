<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">
<body>

<?php

$id = $_GET['student_id'];
$stm = $dbh->query("SELECT * FROM students WHERE student_id = $id");
$person = $stm->fetch();
$anrede = $person->name;

echo "
    <div class='formular'>
    <form method='post'>
    <h3>Deine Daten: </h3>
    <input type='text' class='formcss' pattern='[A-Z][a-z*' title='Es sind nur Buchstaben erlaubt' value='$name' placeholder='Vor- und Nachname' name='name'><br>
    <input type='email' class='formcss' value='$email' placeholder='Email' name='mail'><br><br>
    <h3>Deine Nachricht an $anrede</h3>    
    <textarea name='text'></textarea><br>
    <input type='submit'   value='Senden' name='submit'><br>
    </form>";

if (isset($_POST['submit'])) {
    $to = $person->mail;
    $name = $_POST['name'];
    $from = $_POST['mail'];
    $message = $_POST['text'];
    $header = 'From: ' .$from . "\r\n" .
        'Reply-To: '.$from .  "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $name, $message, $header);

    echo '<p>Deine Nachricht wurde erfolgreich übermittelt<p></div>';
    } ?>
<?php include "footer.php";?>
</body>


<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
der Fachhochschule Salzburg, Studiengang Multimediatechnology.
Idee und Umsetzung von Elias Cia -->