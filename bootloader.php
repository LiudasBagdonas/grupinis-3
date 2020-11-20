<?php

session_start();

define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/db.json');

require 'core/functions/html.php';
require 'core/functions/file.php';
require 'core/functions/auth.php';
require 'core/functions/form/core.php';
require 'core/functions/form/validators.php';
require 'app/functions/form/validators.php';
require 'app/functions/generators.php';
