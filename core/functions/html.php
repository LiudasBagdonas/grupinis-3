<?php
function html_attr(array $attr): string
{
	$att_string = '';
	foreach ($attr as $att_name => $att_value) {
		if ($att_name === 'readonly') {
			$att_string .= $att_name;
		} else {
			$att_string .= "$att_name=\"$att_value\" ";
		}
	}

	return $att_string;
}

function form_attr($form)
{
	$defaults = ['method' => 'POST'];
	return html_attr(($form['attr'] ?? []) + $defaults);
}

function input_attr(string $field_name, array $field): string
{
	$attributes = [
		'name' => $field_name,
		'type' => $field['type'],
		'value' => $field['value'] ?? ''
	] + ($field['extras']['attr'] ?? []);

	return html_attr($attributes);
}

function select_attr(string $select_name, array $select_value): string
{
	$attributes = [
		'name' => $select_name,
		'value' => $select_value['value'],
	] + ($select_value['extras']['attr'] ?? []);

	return html_attr($attributes);
}

function option_attr(string $option_name, array $select): string
{
	$attributes = [
		'value' => $option_name,
	];

	if ($select['value'] === $option_name) {
		$attributes['selected'] = 'selected';
	}

	return html_attr($attributes);
}

function textarea_attr(string $textarea_name, array $textarea): string
{
	$attributes = [
		'name' => $textarea_name,
		'rows' => $textarea['rows'],
		'cols' => $textarea['cols'],
	] + ($textarea['extras']['attr'] ?? []);

	return html_attr($attributes);
}

function button_attr(string $button_id, array $button): string
{
	$attributes = [
		'name' => 'action',
		'type' => $button['type'] ?? 'submit',
		'value' => $button_id,
	] + ($button['extras']['attr'] ?? []);

	return html_attr($attributes);
}
