<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">

<?php
$sth = $dbh->query(
    "SELECT students.name, students.mail, entries.training_level, entries.text, students.student_id FROM entries, students 
     WHERE entries.sport_id = '4' AND entries.student_id = students.student_id"
);
$personen = $sth->fetchAll();?>

<body>
<div class="überschrift">
    <h1>Radfahren</h1> <a id="entry" href="new_entry.php">Eintrag erstellen</a>
</div>
<article>
    <div class="body">
        <ul>
            <?php  foreach( $personen as $person ) : ?>
                <li>
                    <p><h2>Name:</h2><?php echo $person->name?>
                    <h2>Level:</h2><?php echo $person->training_level?>
                    <h2>Anmerkung:</h2><?php echo $person->text?></p>
                    <a id="button" href="contact.php?student_id=<?php echo $person->student_id ?>">kontaktieren</a>
                    <?php
                    if($name == $person->name)
                    {
                        echo "<a id='button' href='delete_entry.php?student_id=".($person->student_id)."&sport_id=4'>Eintrag löschen</a>";
                    }
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