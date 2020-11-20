<?php

require '../../bootloader.php';

$nav_array = nav();

$player_array = file_to_array(DB_FILE);

foreach($player_array as $player) {
    if ($player['email'] === $_SESSION['email'])
    {
        $curent_player = $player;
    }
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'more_cash' => [
            'label' => 'Your cash: $' . $curent_player['cash'],
            'type' => 'number',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_numeric',
                'validate_field_range' => [
                    'min' => 5,
                    'max' => 100,
                ],
            ],
        ],
    ],
    'buttons' => [
        'cash-in' => [
            'title' => 'GIEF CASH',
            'type' => 'submit',
            'extras' => [
                'class' => 'btn',
            ]
        ]
    ],
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    if (validate_form($form, $clean_inputs)) {
        foreach($player_array as &$player) {
            if ($player['email'] === $curent_player['email'])
            {
                $player['cash'] += $clean_inputs['more_cash'];
                array_to_file($player_array, DB_FILE);
            }
        }

    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../media/style.css">
    <title>Cash-in</title>
</head>

<body>
    <article class="wrapper">
        <header>
            <?php require ROOT . '/core/templates/nav.tpl.php'; ?>
        </header>
        <main>
            <h2>CASH-IN</h2>
            <?php require ROOT . '/core/templates/form.tpl.php' ?>
        </main>
    </article>
</body>

</html>
