<?php

// Preparar entorno para Vercel (sistema de archivos de solo lectura)
if (isset($_ENV['VERCEL']) || getenv('VERCEL') || is_dir('/tmp')) {
    $directories = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
        '/tmp/bootstrap/cache',
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    putenv('APP_STORAGE_PATH=/tmp/storage');
    putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

    // Copiar la base de datos SQLite a /tmp si existe en el proyecto
    $dbSource = __DIR__ . '/../database/database.sqlite';
    $dbTarget = '/tmp/database.sqlite';
    if (file_exists($dbSource) && !file_exists($dbTarget)) {
        @copy($dbSource, $dbTarget);
    }

    if (file_exists($dbTarget)) {
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=' . $dbTarget);
        $_ENV['DB_CONNECTION'] = 'sqlite';
        $_ENV['DB_DATABASE'] = $dbTarget;
    }
}

require __DIR__.'/../public/index.php';
