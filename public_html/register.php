<?php

require '../bootloader.php';

$nav_array = nav();

if (is_logged_in()) {
    header("Location: /index.php");
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'nickname' => [
            'label' => 'Nickname *',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_nickname',
                'validate_user_unique',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Creative nickname (less than 50 char.)',
                    'class' => 'input-field',
                ]
            ]
        ],

        'email' => [
            'label' => 'Email *',
            'type' => 'email',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
                'validate_user_unique',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => '@mail',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password' => [
            'label' => 'Password *',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_password_length',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Password (at least 8 char.)',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Repeat password *',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Repeat password',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Register',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $is_valid = validate_form($form, $clean_inputs);

    if ($is_valid) {
        unset($clean_inputs['password_repeat']);

        // Get data from file
        $input_from_json = file_to_array(ROOT . '/app/data/db.json');
        $clean_inputs['cash']= 0;
        $clean_inputs['play']= 0;
        // Append new data from form
        $input_from_json[] = $clean_inputs;
        // Save old data together with appended data back to file
        array_to_file($input_from_json, ROOT . '/app/data/db.json');

        $text_output = 'Registration is OK';
    } else {
        $text_output = 'Registration failed';
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Naujo vartotojo registracija</title>
        <link rel="stylesheet" href="media/style.css">
</head>
<body>
    <article class="wrapper">
        <header>
            <?php require ROOT . '/core/templates/nav.tpl.php' ?>
        </header>
    </article>
    <main>
        <h2>Register</h2>
        <?php require ROOT . '/core/templates/form.tpl.php'; ?>
        <h3 class="registration_error"><?php if (isset($text_output)) print $text_output; ?></h3>
    </main>
</body>
</html>
