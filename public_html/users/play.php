<?php

require '../../bootloader.php';

$nav_array = nav();

$form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'play_form',
    ],
    'fields' => [
        'bet_amount' => [
            'label' => 'Bet amount in $',
            'type' => 'numeric',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_is_numeric',
                'validate_field_is_integer',
                'validate_field_is_positive',
                'validate_field_is_sufficient_cash',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter bet amount',
                    'class' => 'input-field',
                ],
            ],
        ],
        'select' => [
            'label' => 'Bet coefficient',
            'type' => 'select',
            'value' => '',
            'options' => [
                'cof_1' => 'Lyginiai skaičiai (Koef. 1,5)',
                'cof_2' => 'Nelyginiai skaičiai (Koef. 1,5)',
                'cof_3' => '1 (Koef. 3)',
                'cof_4' => '6 (Koef. 3)',
            ],
            'validators' => [
                'validate_select',
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter password',
                    'class' => 'input-field',
                ],
            ],
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'BET',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $form_success = validate_form($form, $clean_inputs);

    if ($form_success) {
        $roll = rand(1, 6);
        if (game($clean_inputs, $roll)) {
            $message = 'YOU WIN!';
        } else {
            $message = 'YOU LOSE!';
        }
    }
}

$h2 = "Turimi pinigai: $_SESSION[cash]$";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../media/style.css">
    <title>Play</title>
</head>

<body>
<header>
    <article class="wrapper">
        <?php require ROOT . '/core/templates/nav.tpl.php'; ?>
    </article>
</header>
<main>
    <article class="wrapper">
        <h2>PLAY</h2>
        <h2><?php print $h2; ?></h2>
        <?php require ROOT . '/core/templates/form.tpl.php'; ?>
        <?php if (isset($roll)) : ?>
            <h2 class="win_message"><?php print $message; ?></h2>
            <h2><?php print $roll; ?></h2>
        <?php endif; ?>
    </article>
</main>
</body>

</html>