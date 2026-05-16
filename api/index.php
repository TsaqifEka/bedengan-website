<?php

// Tanda bahwa kita sedang berada di dalam server Vercel
define('IS_VERCEL', true);

// 1. Buat folder bayangan secara fisik di /tmp server Vercel
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

// 2. Beritahu Laravel untuk membuang file sistem internal ke /tmp
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';
$_SERVER['APP_CONFIG_CACHE']   = '/tmp/bootstrap/cache/config.php';
$_SERVER['APP_ROUTES_CACHE']   = '/tmp/bootstrap/cache/routes-v7.php';
$_SERVER['APP_EVENTS_CACHE']   = '/tmp/bootstrap/cache/events.php';

// 3. Panggil mesin utama Laravel
require __DIR__ . '/../public/index.php';