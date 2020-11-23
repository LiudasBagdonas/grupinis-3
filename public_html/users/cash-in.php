<?php

require '../../bootloader.php';

$nav_array = nav();

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'more_cash' => [
            'label' => 'Your cash: $' . $_SESSION['cash'],
            'type' => 'number',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_numeric',
                'validate_field_is_integer',
                'validate_field_range' => [
                    'min' => 5,
                    'max' => 100,
                ],
            ],
        ],
    ],
    'buttons' => [
        'cash-in' => [
            'title' => 'GIEF CASH!',
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
        $data = file_to_array(DB_FILE);
        foreach ($data as &$player) {
            if ($player['email'] === $_SESSION['email']) {
                $player['cash'] += $clean_inputs['more_cash'];
                $_SESSION['cash'] = $player['cash'];
                array_to_file($data, DB_FILE);
                header('Location: /users/cash-in.php');
            }
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../media/style.css">
    <title>Cash-in</title>
</head>

<body>
<header>
    <article class="wrapper">
        <?php require ROOT . '/core/templates/nav.tpl.php'; ?>
    </article>
</header>
<main>
    <article class="wrapper">
        <h2>CASH-IN</h2>
        <?php require ROOT . '/core/templates/form.tpl.php' ?>
    </article>
</main>
</body>

</html>