<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\RotatingFileHandler;

// create a log channel
$log = new Logger('logger');

//Log to stdout
$stdoutHandler = new ErrorLogHandler();
$formatter = new JsonFormatter();
$stdoutHandler->setFormatter($formatter);

// File Handler
$fileHandler = new RotatingFileHandler(__DIR__.'/logs/app.log', 0, \Monolog\Level::Debug);
$formatter = new JsonFormatter();
$fileHandler->setFormatter($formatter);

// Register Handlers
$log->pushHandler($fileHandler);
$log->pushHandler($stdoutHandler);


// My Application
$options = getopt('a:b:');

# App Servidor A
if ($options['a'] === 'warning') {
    $log->warning('Esto es un nuevo Warning', ['Servidor' => 'Servidor A']);
} else {
    $log->info('Esto es un Info', ['Servidor' => 'Servidor A']);
}

# App Servidor B
if ($options['b'] === 'error') {
    $log->error('Esto es un Error', ['Servidor' => 'Servidor B']);
} else {
    $log->info('Esto es un Info', ['Servidor' => 'Servidor B']);
}



