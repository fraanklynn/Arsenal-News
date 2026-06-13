<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek maintenance mode (karena sekarang di root, cukup ./storage)
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register autoloader (sekarang langsung di ./vendor)
// Paksa ke lokasi root yang benar
require '/var/www/html/vendor/autoload.php';

// Bootstrap Laravel (sekarang langsung di ./bootstrap)
/** @var Application $app */
$app = require_once '/var/www/html/bootstrap/app.php';

$app->handleRequest(Request::capture());