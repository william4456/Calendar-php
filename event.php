<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>événement</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'database.php';
    $param =  $_GET["id"];
    $reponse = $bdd->query("SELECT * FROM events WHERE id = '$param'");

    while ($donnees = $reponse->fetch()) {
        ?>
        <div class="container">
            <a href="index.php">Calendrier</a>
            <div class="row">
                <div class="col-sm">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h1 class="mx-auto ">
                                <?= $donnees['name']; ?>
                            </h1>
                        </div>

                        <div class="card-body">
                            <p class="card-title pricing-card-title">
                                <small class="text-muted"> <?= $donnees['description']; ?>
                                </small>
                            </p>
                            <p class="card-link"><?= $donnees['date']; ?></p>
                        </div>
                    </div>
                    <?php
                        if (isset($_POST["delete"])) {
                            echo "aaaa";
                            mysql_query("DELETE FROM events WHERE id='$param'")
                                or die(mysql_error());
                        }
                        ?>
                </div>

            </div>
        <?php
        }
        ?>
</body>

</html>