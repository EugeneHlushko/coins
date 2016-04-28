<?php
namespace App\views;

class Error {
    public static function render() {
        ob_start();
        ?>
        <div class="error">
            <p>Error occured!</p>
            <p>
                Please go to our <a href="/">Homepage</a>
            </p>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}