<?php
namespace App\utils;

class Renderer {
    public static function render($page) {
        $header = new \App\views\partials\Header();
        $footer = new \App\views\partials\Footer();
        $header->render();
        switch ($page) {
            case 'index':
                $index = new \App\views\Index();
                $index->render();
                break;
            case 'error':
            default:
                $error = new \App\views\Error();
                $error->render();
        }
        $footer->render();
    }
}