<?php
namespace App\utils;

class Router {
    const INDEX = '/';
    const AJAX = '/ajax';

    public static function parseRoute() {
        $currentPath = strtok($_SERVER["REQUEST_URI"],'?');
        switch ($currentPath) {
            case self::INDEX:
                return 'index';
                break;
            case self::AJAX:
                return 'ajax';
                break;
            default:
                return 'error';
        }
    }
}