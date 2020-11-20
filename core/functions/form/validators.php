<?php

// //////////////////////////////
// [1] FORM VALIDATORS
// //////////////////////////////

/**
 * Check if field values are the same
 *
 * @param $form_values
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_fields_match($form_values, array &$form, array $params): bool
{
    foreach ($params as $field_index) {
        if ($form_values[$params[0]] !== $form_values[$field_index]) {
            $form['fields'][$field_index]['error'] = strtr('laukelis nesutampa su @field laukeliu', [
                '@field' => $form['fields'][$params[0]]['label']
            ]);

            return false;
        }
    }

    return true;
}

// //////////////////////////////
// [2] FIELD VALIDATORS
// //////////////////////////////


/**
 * Check if field is not empty
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_field_not_empty(string $field_value, array &$field): bool
{

    if ($field_value == '') {
        $field['error'] = 'Field can\'t be empty';
        return false;
    }

    return true;
}

/**
 * Chef if field contains space
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_field_contains_space(string $field_value, array &$field): bool
{
    if (str_word_count(trim($field_value)) < 2) {
        $field['error'] = 'Žodžiai privalo būti atskirti tarpu';
        return false;
    }

    return true;
}


/**
 * Check if selected value is one of the possible options in options array
 *
 * @param string $field_input
 * @param array $field
 * @return bool
 */
function validate_select(string $field_input, array &$field): bool
{
    if (!isset($field['options'][$field_input])) {
        $field['error'] = 'Input doesn\'t exist';

        return false;
    }

    return true;
}

/**
 * Check if provided email is in correct format
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_email(string $field_value, array &$field): bool
{
    if (!preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $field_value)) {

        $field['error'] = 'Invalid email format';

        return false;
    }

    return true;
}

/**
 *  Check if provided nickname isn't longer than 50 symbols
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_nickname(string $field_value, array &$field): bool
{
    if (strlen($field_value) > 50) {
        $field['error'] = 'Nickname must be shorter';
        return false;
    }

    return true;
}

/**
 * Check if provided password isn't shorter than 8 symbols
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_password_length(string $field_value, array &$field): bool
{
    if (strlen($field_value) < 8) {
        $field['error'] = 'Password must be longer than your d*ck';
        return false;
    }

    return true;
}

