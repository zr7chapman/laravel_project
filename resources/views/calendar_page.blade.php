<?php

require 'CalendarController.php';

function h($s){
    return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

$cal=App\Http\Controller\CalendarController();

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カレンダーページ</title>
    <link rel="stylesheet" href="css/calendar.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th><a href="/?t=<?php print h($cal->$prev);?>">&laquo;</a></th>
                <th colspan="5"><?php print h($cal->$yearMonth);?></a></th>
                <th><a href="/?t=<?php print h($cal->$next);?>">&raquo;</a></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sun</td>
                <td>Mon</td>
                <td>Tue</td>
                <td>Wed</td>
                <td>Thu</td>
                <td>Fri</td>
                <td>Sat</td>
            </tr>

            <?php $cal->show(); ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7"><a href="/">Today</a></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>

