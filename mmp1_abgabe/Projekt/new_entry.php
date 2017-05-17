<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">

<?php
echo "
    <div class=\"überschrift\">
    <h1>neuer Eintrag</h1>
    </div>
    
    <div class='formular'>
    <form method='post' action='new_entry.php'>
        <h3>Deine Daten:</h3>
        <input class='formcss' type='text' pattern='[A-Z][a-z*' title='Es sind nur Buchstaben erlaubt' value='$name' placeholder='Vor- und Nachname' name='name' readonly><br>        
        <input class='formcss' type='email' value='$email' placeholder='Email' name='mail'><br><br> 
        <h3>Sportart und Level</h3>
        <select class='formcss' name='sport'>
            <option>Beachvolleyball</option>
            <option>Laufen</option>
            <option>Longboarding</option>
            <option>Radfahren</option>
            <option>Wandern</option>
            <option>Sonstige</option>
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
    ";




if(isset($_POST['submit'])) {
    htmlspecialchars($name_input = $_POST['name']);
    $sth = $dbh->query("SELECT COUNT(*) FROM students  WHERE '$name_input' = name");

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
    $stm = $dbh->query("SELECT * FROM students  WHERE '$name_input' = name");
    $person = $stm->fetch();

    //Sportart -> ID
    htmlspecialchars($foo = $_POST['sport']);
    $sport_input = get_sport($foo);

    //neuer Eintrag in entries
    $sth = $dbh->prepare("INSERT INTO entries (student_id, sport_id, training_level, text) 
                    VALUES ($person->student_id, $sport_input, ?, ?)");
    $sth->execute(
        array(
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