<?php

function validate_field_not_empty(string $field_value, array &$field): bool
{
	if ($field_value === '') {
		$field['error'] = 'ERROR TU DURNS, PARAŠYK KAŽKĄ';
		return false;
	}
	return true;
}

function validate_field_range(string $field_value, array &$field, array $params): bool
{
	if ($field_value < $params['min']) {
		$field['error'] = 'Minimal cash-in sum is $' . $params['min'];
		return false;
	} elseif ($field_value > $params['max']) {
        $field['error'] = 'Maximum cash-in sum is $' . $params['max'];
		return false;
    }
	return true;
}

function validate_field_is_numeric(string $field_value, array &$field): bool
{
	if (!(is_numeric($field_value))) {
		$field['error'] = 'THAT\'S NOT A NUMBER FOOL';
		return false;
	}
	return true;
}