<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Determine The Application Base Path
|--------------------------------------------------------------------------
|
| Supports two deployment layouts:
| 1. Standard: public/ is inside the Laravel project folder
| 2. cPanel:   public_html/ is separate, Laravel files in ../nexatax/
|
*/

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    // Standard layout: index.php inside project/public/
    $basePath = __DIR__.'/..';
} else {
    // cPanel layout: index.php in public_html/, Laravel in ../nexatax/
    $basePath = __DIR__.'/../nexatax';
}

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = $basePath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require $basePath.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once $basePath.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
