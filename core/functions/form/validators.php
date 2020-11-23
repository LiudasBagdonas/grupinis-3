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
function validate_fields_match($form_values, array &$form, array $params): bool {
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
function validate_field_not_empty(string $field_value, array &$field): bool {
    if ($field_value == '') {
        $field['error'] = 'Field can\'t be empty';
        return false;
    }

    return true;
}

/**
 * Check if the provided value is in the designated value range
 *
 * @param string $field_value
 * @param array $field
 * @param array $params contains the min and max values
 * @return boolean
 */
function validate_field_range(string $field_value, array &$field, array $params): bool {
    if ($field_value < $params['min']) {
        $field['error'] = 'Minimal cash-in sum is $' . $params['min'];
        return false;
    } elseif ($field_value > $params['max']) {
        $field['error'] = 'Maximum cash-in sum is $' . $params['max'];
        return false;
    }
    return true;
}

/**
 * Check if provided value is a number
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_is_numeric(string $field_value, array &$field): bool {
    if (!(is_numeric($field_value))) {
        $field['error'] = 'THAT\'S NOT A NUMBER FOOL';
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
function validate_select(string $field_input, array &$field): bool {
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
function validate_email(string $field_value, array &$field): bool {
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
function validate_nickname(string $field_value, array &$field): bool {
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
function validate_password_length(string $field_value, array &$field): bool {
    if (strlen($field_value) < 8) {
        $field['error'] = 'Password must be longer than your d*ck';
        return false;
    }

    return true;
}

/**
 * Check if provided value is positive
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_is_positive(string $field_value, array &$field): bool {
    if ($field_value < 0 || $field_value == 0) {
        $field['error'] = 'Bet amount has to be positive number';
        return false;
    }
    return true;
}

/**
 * Check if users has sufficient cash
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_is_sufficient_cash(string $field_value, array &$field): bool {
    if (!($_SESSION['cash'] >= $field_value)) {
        $field['error'] = 'Insufficient funds';
        return false;
    }
    return true;
}

/**
 * Check if users has sufficient cash
 *
 * @param string $field_value
 * @param array $field
 * @return boolean
 */
function validate_field_is_integer(string $field_value, array &$field): bool {
    if ((strpos($field_value, '.') || strpos($field_value, ','))) {
        $field['error'] = 'Don\'t play with cents, please';
        return false;
    }
    return true;
}

