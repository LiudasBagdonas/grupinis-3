<?php

function array_to_file(array $array, string $file_name): bool
{
	$string_array = json_encode($array);
	$bytes_written = file_put_contents($file_name, $string_array);

	return $bytes_written !== false;
}

function file_to_array(string $file_name)
{
	return
		file_exists($file_name) ?
		json_decode(file_get_contents($file_name), true) ?? [] :
		false;
}
