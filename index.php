<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Calendrier</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php
    require('./date/Month.php');
    $month = new App\Date\Month($_GET['month'], $_GET['year']);
    $start = $month->getStartingDay()->modify('last monday');
    //$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
    ?>
    <div class="d-flex justify-content-center mx-sm-3 mt-3">
        <h1><?= $month->__toString(); ?></h1>
    </div>
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <a href="/index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt</a>
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
                            <div class="calendar_day"><?= $date->format('d'); ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>

</body>

</html>