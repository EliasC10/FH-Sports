<?php
include "head.php";

$sth = $dbh->query("SELECT * FROM sports ORDER BY sport_id ASC");
$sports = $sth->fetchAll();?>



<link rel="stylesheet" href="sportstyle.css">


    <div class="überschrift">
    <h1>neuer Eintrag</h1>
    </div>
    
    <div class='formular'>

    <form method='post' action='new_entry.php'>
        <h3>Deine Daten:</h3>

        <input class='formcss' type='text' pattern='[A-Z][a-z*' title='Es sind nur Buchstaben erlaubt'
               value='<?php echo $name?>' placeholder='Vor- und Nachname' name='name' readonly><br>

        <input class='formcss' type='email' value='<?php echo $email?>' placeholder='Email' name='mail'><br><br>

        <h3>Sportart und Level</h3>

        <select class='formcss' name='sport'>
            <?php foreach($sports as $sport) : ?>
            <option value='<?php echo $sport->sport_id?>'><?php echo $sport->sport ?></option>
            <?php endforeach; ?>
        </select><br>

        <select class='formcss' name='Trainingsstand'>
            <option>Anfänger</option>
            <option selected>Durchschnitt</option>
            <option>Fortgeschritten</option>
            <option>Profi</option>
        </select><br><br>

        <h3>Anmerkung:</h3>

        <textarea name='text' placeholder='max 250 Zeichen'></textarea><br>
        <input type='submit'   value='Eintrag erstellen' name='submit'>    
    </form>      


<?php

if(isset($_POST['submit'])) {
    $name_input = $_POST['name'];
    $sth = $dbh->prepare("SELECT COUNT(*) FROM students  WHERE ? = name");
    $sth->execute(
            array($name_input)
    );

    //überpfrüt ob die Person schon existiert
    if($column = $sth->fetchColumn() == 0) {
        //Person anlegen
        $sth = $dbh->prepare("INSERT INTO students (name, mail)
                    VALUES (?, ?)");
        $sth->execute(
            array(
                $_POST['name'],
                $_POST['mail']
            )
        );
    };

    //DB-Query damit wir die id der gerade angelegten Person od. bereits angelegten Person verwenden können
    $stm = $dbh->prepare("SELECT * FROM students  WHERE name = ?");
    $stm->execute(array($name_input));
    $person = $stm->fetch();

    //neuer Eintrag in entries
    $sth = $dbh->prepare("INSERT INTO entries (student_id, sport_id, training_level, text) 
                    VALUES ($person->student_id, ?, ?, ?)");
    $sth->execute(
        array(
            $_POST['sport'],
            $_POST['Trainingsstand'],
            $_POST['text']
        )
    );
    echo '<p>Eingabe war erfolgreich</p></div>';
}?>
</div>
<?php include "footer.php";?>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
             Idee und Umsetzung von Elias Cia -->
