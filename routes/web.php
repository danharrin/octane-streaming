<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/stream', function () {
    return response()->stream(function () {
        echo 1;

        ob_flush();
        flush();
        sleep(1);

        echo 2;

        ob_flush();
        flush();
        sleep(1);

        echo 3;

        ob_flush();
        flush();
        sleep(1);

        echo 4;

        ob_flush();
        flush();
        sleep(1);

        echo 5;
    }, 200, [
        'Content-Type' => 'text/html; charset=utf-8;',
        'Cache-Control' => 'no-cache',
        'X-Accel-Buffering' => 'no',
    ]);
});
