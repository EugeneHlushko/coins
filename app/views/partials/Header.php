<?php
namespace App\views\partials;

class Header {
    public static function render() {
        ob_start();
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title>Coins calculator</title>
            <meta name="description" content="A simple coins calculator application">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="assets/css/styles.min.css">
        </head>
        <body>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}