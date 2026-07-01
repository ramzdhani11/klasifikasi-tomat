<?php

// Entry point untuk shared hosting yang domain-nya mengarah ke root 
// folder project, bukan ke subfolder public/
// Path ini mengarah ke public/index.php Laravel yang sebenarnya

define('LARAVEL_START', microtime(true));

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
