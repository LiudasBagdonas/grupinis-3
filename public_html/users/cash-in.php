<?php

require '../../bootloader.php';

$nav_array = nav();

$form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'cash_form',
    ],
    'fields' => [
        'more_cash' => [
            'label' => '___placeholder___for_cash_from_db',
            'type' => 'number',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
                'validate_is_numeric',
                'validate_min_value',
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
]

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
            <?php require ROOT . '/core/templates/form.tpl.php' ?>
        </main>
    </article>
</body>

</html>