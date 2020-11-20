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
			'visible' => true,
		],
		'Register' => [
			'path' => '../register.php',
			'visible' => true,
		],
		'Cash-in' => [
			'path' => '../users/cash-in.php',
			'visible' => true,
		],
		'Play' => [
			'path' => '../users/play.php',
			'visible' => true,
		],
		'Logout' => [
			'path' => '../logout.php',
			'visible' => true,
		],
	];

	return $nav_array;
}
