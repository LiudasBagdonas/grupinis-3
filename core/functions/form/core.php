<?php

function get_clean_input(array $form)
{
    $parameters = [];
    foreach ($form['fields'] as $index => $input) {
        $parameters[$index] = FILTER_SANITIZE_SPECIAL_CHARS;
    }
    return filter_input_array(INPUT_POST, $parameters);
}

function validate_form(array &$form, array $form_values): bool
{
    $valid = true;

    foreach ($form['fields'] as $index => &$field) {
        foreach ($field['validators'] ?? [] as $function_name => $function_value) {
            if (is_array($function_value)) {
                if (!($function_name($form_values[$index], $field, $function_value))) {
                    $valid = false;
                    break;
                }
            } else {
                if (!($function_value($form_values[$index], $field))) {
                    $valid = false;
                    break;
                }
            }
        }
    }

    foreach ($form['validators'] ?? [] as $validator_name => $validator_value) {
        if (is_array($validator_value)) {
            if (!($validator_name($form_values, $form, $validator_value))) {
                $valid = false;
                break;
            }
        } else {
            if (!($validator_value($form_values, $form))) {
                $valid = false;
                break;
            }
        }
    }

    return $valid;
}
