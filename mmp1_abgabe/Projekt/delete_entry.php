
<?php
header("Location: https://users.multimediatechnology.at/~fhs39917/mmp1/index.php");
include "head.php";

$id = $_GET['student_id'];
$sport = $_GET['sport_id'];
$stm = $dbh->query("SELECT * FROM students WHERE student_id = $id");
$person = $stm->fetch();

if($name == $person->name)
    {
      $dbh->exec("DELETE FROM entries WHERE student_id = $id AND sport_id = $sport");
    }



die();
?>












