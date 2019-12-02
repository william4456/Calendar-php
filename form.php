<?php
include_once 'database.php';

if (isset($_POST['save'])) {
    $id += 1;
    $name = $_POST['name'];
    $resume = $_POST['resume'];
    $date = $_POST['date'];
    $sql = "INSERT INTO events (id, name, resume, date) VALUES ('$id', '$name','$resume', '$date')";
    if ($bdd->exec($sql)) {
        header("Location: /");
        die();
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($bdd);
    }
    mysqli_close($bdd);
}
