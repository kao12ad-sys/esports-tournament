<?php

use CodeIgniter\Boot;
use Config\Paths;

define('FCPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
chdir(FCPATH);

$_SERVER['SCRIPT_NAME'] = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/index.php';
$_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];

require FCPATH . 'app/Config/Paths.php';

$paths = new Paths();

require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));
