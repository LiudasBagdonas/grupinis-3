<?php

require '../bootloader.php';

$nav_array = nav();
$rows = file_to_array(DB_FILE);

foreach ($rows as &$row) {
    unset($row['email']);
    unset($row['password']);
}

$table = [
    'headers' => [
        'Player',
        'Cash',
        'Times Played'
    ],
    'rows' => $rows
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistics</title>
    <link rel="stylesheet" href="media/style.css">
</head>
<body>
<header>
    <?php require ROOT . './core/templates/nav.tpl.php';?>
</header>
<main>
    <h2>Players stats</h2>
    <article class="wrapper table_box">
        <?php require ROOT . '/core/templates/table.tpl.php'; ?>
    </article>
</main>
</body>
</html>

