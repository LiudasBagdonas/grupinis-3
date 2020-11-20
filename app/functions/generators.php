<?php

function nav()
{
	$nav_array = [
		'Stats' => [
			'path' => '../index.php',
			'visible' => true,
		],
		'Login' => [
			'path' => '../login.php',
			'visible' => !is_logged_in(),
		],
		'Register' => [
			'path' => '../register.php',
			'visible' => !is_logged_in(),
		],
		'Cash-in' => [
			'path' => '../users/cash-in.php',
			'visible' => is_logged_in(),
		],
		'Play' => [
			'path' => '../users/play.php',
			'visible' => is_logged_in(),
		],
		'Logout' => [
			'path' => '../logout.php',
			'visible' => is_logged_in(),
		],
	];

	return $nav_array;
}

