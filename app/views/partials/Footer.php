<?php
namespace App\views\partials;

class Footer {
    public static function render() {
        ob_start();
        ?>
            <script src="assets/js/app.min.js"></script>
        </body>
        </html>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}