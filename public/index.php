<?php
// Jalur absolut yang pasti benar di Docker Railway
require '/var/www/html/vendor/autoload.php';
$app = require_once '/var/www/html/bootstrap/app.php';

$app->handleRequest(Illuminate\Http\Request::capture())->send();