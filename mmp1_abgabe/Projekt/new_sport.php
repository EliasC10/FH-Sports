<?php include "head.php"; ?>
<link rel="stylesheet" href="sportstyle.css">


<div class="überschrift">
    <h1>neue Sportart</h1>
    </div>

    <div class='formular'>
    <form method='post' action='new_sport.php' enctype="multipart/form-data" id="newsport">
        <h3>Sportart:</h3>
        <input class='formcss' type='text' pattern='[A-Z][a-z*' title='Es sind nur Buchstaben erlaubt'
               placeholder='Fußball, Tennis, ...' name='sport'><br>
        <h3>Bild:</h3>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <p> Es wird eine Auflösung von 4:3 empfohlen</p><br>
        <input type='submit'   value='Eintrag erstellen' name='submit'>
</form>


<?php

/* $target_dir = "pictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); */


if(isset($_POST['submit'])) {
    $sport_input = $_POST['sport'];
    $sth = $dbh->prepare("SELECT COUNT(*) FROM sports  WHERE ? = sport");
    $sth->execute(array($sport_input));

    //überpfrüt ob die Sportart bereits existiert
    if($column = $sth->fetchColumn() == 0) {
        //Sportart anlegen

        $target_dir = "pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false){
            $uploadOk = 1;
        } else {
            echo"Die Datei ist kein Bild.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 6000000) {
            echo "Die Datei ist zu groß!";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && !$imageFileType != "gif") {
            echo "Es sind nur die Bildformate jpg, png, jpeg, gif erlaubt.";
        }

        if ( $uploadOk == 0){
            echo "Die Sportart konnte nicht angelegt werden!";
        } else {
               move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $sport_input . "." . $imageFileType);

                $sth = $dbh->prepare("INSERT INTO sports (sport, picture) VALUES (?, ?)");
                $sth->execute(
                    array(
                            $_POST['sport'],
                            $_POST['sport'] . "." . $imageFileType

                        )
                );

                echo '<p>Eingabe war erfolgreich</p></div>';

            }


    };


}?>
</div>
<?php include "footer.php";?>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
             Idee und Umsetzung von Elias Cia -->
