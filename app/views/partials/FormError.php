<?php
namespace App\views\partials;

class FormError {
    public static function render($key, $value) {
        ob_start();
        ?>
        <div class="form-row error <?= $key ?>">
            <p>
                <?= $value ?>
            </p>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}