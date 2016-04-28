<?php
/*
 * This Class render content
 */
namespace App\utils;

class Renderer {
    public static function render($page) {
        $header = new \App\views\partials\Header();
        $footer = new \App\views\partials\Footer();
        $content = '';
        switch ($page) {
            case 'index':
                $index = new \App\views\Index();
                $content .= $header->render();
                $content .= $index->render();
                $content .= $footer->render();
                break;
            case 'ajax':
                $ajax = new \App\views\Ajax();
                $content .= $ajax->render();
                break;
            case 'error':
            default:
                $error = new \App\views\Error();
                $content .= $header->render();
                $content .= $error->render();
                $content .= $footer->render();
        }

        echo $content;
    }
}