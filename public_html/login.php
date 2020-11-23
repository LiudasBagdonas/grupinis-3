<?php

require '../bootloader.php';

$nav_array = nav();

$form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'login_form',
    ],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter email',
                    'class' => 'input-field',
                ],
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'validators' => [
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
            'title' => 'Login',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
    'validators' => [
        'validate_login' => [
            'email',
            'password',
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $form_success = validate_form($form, $clean_inputs);

    if ($form_success) {
        $users_db = file_to_array(ROOT . '/app/data/db.json');

        foreach ($users_db as $user) {

            if (
                $clean_inputs['email'] === $user['email']
                && $clean_inputs['password'] === $user['password']
            ) {
                $_SESSION = $user;
            }
        }
        header('Location: /users/cash-in.php');
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="media/style.css">
    <title>Login</title>
</head>

<body>
    <header>
        <article class="wrapper">
            <?php require ROOT . './core/templates/nav.tpl.php'; ?>
        </article>
    </header>
    <main>
        <article class="wrapper">
            <h2>Login</h2>
            <?php require ROOT . '/core/templates/form.tpl.php'; ?>
        </article>
    </main>
</body>

</html>