<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Calendrier</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un événement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="form.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nom</label>
                            <input name="name" class="form-control" id="exampleInputEmail1" placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date (format année-mois-jour)</label>
                            <input type="text" name="date" class="form-control" id="exampleInputEmail1" placeholder="Date">
                        </div>
                        <input type="submit" name="save" value="submit">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save" class="btn btn-primary">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('./date/Month.php');
    include_once 'database.php';

    $month = new App\Date\Month($_GET['month'], $_GET['year']);
    $start = $month->getStartingDay()->modify('last monday');
    ?>

    <div class="d-flex justify-content-center mx-sm-3 mt-3">
        <h1><?= $month->__toString(); ?></h1>
    </div>

    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <a href="/index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt</a>
        <button type="button" id="add-btn" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
            Créer
        </button>
        <a href="/index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt</a>
    </div>
    <br>
    <div class="d-flex justify-content-center mx-sm-3">
        <table class="calendar_table calendar_table-<?= $month->getWeeks(); ?>">
            <?php for ($i = 0; $i < $month->getWeeks(); $i++) : ?>
                <tr>
                    <?php foreach ($month->days as $k => $day) :
                            $date = (clone $start)->modify("+" . ($k + $i * 7) . "days");
                            ?>
                        <td class="<?= $month->withinMonth($date) ? '' : 'calendar_othermonth'; ?>">
                            <?php if ($i === 0) : ?>
                                <div class="calendar_weekday"><?= $day; ?></div>
                            <?php endif; ?>

                            <div class="calendar_day">
                                <?= $date->format('d'); ?>
                                <br>
                                <?php
                                        $reponse = $bdd->query('SELECT * FROM events');
                                        while ($donnees = $reponse->fetch()) {
                                            if (date("d-m-Y", strtotime($donnees['date'])) == $date->format('d-m-Y')) { ?>
                                        <a href="event.php?id=<?php echo $donnees['id']; ?>">
                                            <button id="event" type="button" class="btn btn-primary">
                                                <?php echo $donnees['description']; ?>
                                            </button>
                                        </a>
                                <?php }
                                        }
                                        ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</body>

</html>