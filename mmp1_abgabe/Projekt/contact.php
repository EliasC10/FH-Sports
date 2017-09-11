<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">
<body>

<?php

$id = $_GET['student_id'];
$stm = $dbh->prepare("SELECT * FROM students WHERE student_id = ?");
$stm->execute(
        array($id)
);
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
    $message = strip_tags($_POST['text']);
    $header = 'From: ' . $from;


    if (preg_match("/[\r\n]/", $name) ||
        preg_match("/[\r\n]/", $from) ||
        preg_match("/[\r\n]/", $to)   ||
        preg_match("/[\r\n]/", $header)){
        echo "<script>alert('Whyyyyy???')</script>";}

    else {
        mail($to, $name, $message, $header);
        echo '<p>Deine Nachricht wurde erfolgreich übermittelt<p>';}


    } ?>
</div>
<?php include "footer.php";?>
</body>


<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
der Fachhochschule Salzburg, Studiengang Multimediatechnology.
Idee und Umsetzung von Elias Cia -->