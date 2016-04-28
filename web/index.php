<?php
// Bootstrap the application
require __DIR__ . '/../vendor/autoload.php';

$Router = new \App\utils\Router();
$action = $Router->parseRoute();
$renderer = new \App\utils\Renderer();

switch ($action) {
    case 'index':
        $renderer->render('index');
        break;
    case 'ajax':
        $validator = new \App\validators\DetectAmount();
        print_r($validator->detect('1x'));
        break;
    case 'error':
    default:
        $renderer->render('error');
}

