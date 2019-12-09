<?php
include_once 'database.php';

if (isset($_POST['save'])) {
    $id += 1;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $sql = "INSERT INTO events (name, description, date) VALUES ('$name','$description', '$date')";


    if ($bdd->exec($sql)) {
        header("Location: /");
        die();
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($bdd);
    }
    mysqli_close($bdd);
}
