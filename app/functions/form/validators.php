<?php

/**
 * Check if login is successful
 *
 * @param $form_values
 * @param array $form
 * @return bool
 */
function validate_login($form_values, array &$form): bool
{
    $db_data = file_to_array(DB_FILE);

    foreach ($db_data as $entry) {
        var_dump($entry);
        if ($form_values['email'] === $entry['email']
            && $form_values['password'] === $entry['password']) {

            return true;
        }
    }

    $form['error'] = 'Email or password does not match';

    return false;
}

