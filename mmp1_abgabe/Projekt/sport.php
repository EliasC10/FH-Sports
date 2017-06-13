<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">

<?php

$sport = $_GET['sport_id'];
$sth = $dbh->query(
    "SELECT students.name, students.mail, entries.training_level, entries.text, students.student_id FROM entries, students 
     WHERE entries.sport_id = '$sport' AND entries.student_id = students.student_id");
$personen = $sth->fetchAll();

$foo = $dbh->query("SELECT * FROM sports WHERE sport_id = '$sport'");
$sportart = $foo->fetch();
?>


<body>
<div class="überschrift">
    <h1><?php echo $sportart->sport?></h1> <a id="entry" href="new_entry.php">Eintrag erstellen</a>
</div>
<article>
    <div class="body">
        <ul>
            <?php  foreach($personen as $person ) : ?>
                <li>
                    <p><h2>Name:</h2><?php echo $person->name?>
                    <h2>Level:</h2><?php echo $person->training_level?>
                    <h2>Anmerkung:</h2><?php echo $person->text?></p>
                    <?php
                    if($name == $person->name)
                    {
                        echo "<form method='post' action='sport.php?sport_id=".($sportart->sport_id)."'>
                              <input type='submit' value='Eintrag löschen' name='submit'>                                           
                              </form>";

                        if(isset($_POST['submit']))
                            $sth = $dbh->prepare("DELETE FROM entries WHERE student_id = $person->student_id AND sport_id = $sportart->sport_id");
                            $sth->execute();

                    }
                    else echo "<a id='button' href='contact.php?student_id=".($person->student_id)."'>kontaktieren</a>";
                    ?>
                </li>
            <?php endforeach; ?>
            <?php include "footer.php";?>
        </ul>
    </div>
</article>
</body>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
der Fachhochschule Salzburg, Studiengang Multimediatechnology.
Idee und Umsetzung von Elias Cia -->