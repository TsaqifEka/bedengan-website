<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 1. Agar Vercel (sebagai perantara) dipercaya oleh sistem keamanan Laravel
        $middleware->trustProxies(at: '*');

        // 2. Satpam pengatur arah setelah login
        $middleware->redirectTo(
            guests: '/login', // Kalau belum login, arahkan ke halaman login
            users: function () { // Kalau sudah login...
                // Cek apakah dia punya role Admin
                if (Auth::user() && Auth::user()->role && Auth::user()->role->name === 'Admin') {
                    return '/dashboard'; // Lempar ke Dashboard Admin
                }
                return '/'; // Jika pengunjung/user biasa, lempar ke halaman utama
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// --- TAMBAHAN KHUSUS VERCEL ---
if (defined('IS_VERCEL')) {
    $app->useStoragePath('/tmp/storage');
}
// ------------------------------

return $app;