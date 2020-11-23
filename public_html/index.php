<?php

require '../bootloader.php';

$nav_array = nav();

$rows = fix_array();

$table = [
    'headers' => [
        'Player',
        'Cash',
        'Times Played',
    ],
    'rows' => $rows,
];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Statistics</title>
    <link rel="stylesheet" href="media/style.css">
</head>

<body>
    <header>
        <article class="wrapper">
            <?php require ROOT . './core/templates/nav.tpl.php'; ?>
        </article>
    </header>
    <main>
        <article class="wrapper table_box">
            <h2>Players stats</h2>
            <?php require ROOT . '/core/templates/table.tpl.php'; ?>
        </article>
    </main>
</body>

</html>