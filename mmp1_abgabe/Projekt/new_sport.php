<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">


<div class="überschrift">
    <h1>neue Sportart</h1>
    </div>

    <div class='formular'>
    <form method='post' action='new_sport.php'>
        <h3>Sportart:</h3>
        <input class='formcss' type='text' pattern='[A-Z][a-z*' title='Es sind nur Buchstaben erlaubt'
               placeholder='Fußball, Tennis, ...' name='sport'><br>
        <input type='submit'   value='Eintrag erstellen' name='submit'>
</form>


<?php

if(isset($_POST['submit'])) {
    htmlspecialchars($sport_input = $_POST['sport']);
    $sth = $dbh->query("SELECT COUNT(*) FROM sports  WHERE '$sport_input' = sport");

    //überpfrüt ob die Sportart bereits existiert
    if($column = $sth->fetchColumn() == 0) {
        //Sportart anlegen
        $sth = $dbh->prepare("INSERT INTO sports (sport) VALUES (?)");
        $sth->execute(
            array($_POST['sport'])
        );
    };

    echo '<p>Eingabe war erfolgreich</p></div>';
}?>
</div>
<?php include "footer.php";?>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
             Idee und Umsetzung von Elias Cia -->
