<?php
namespace App\views\partials;

class FormError {
    public static function render($key, $value) {
        ?>
        <div class="form-row error <?= $key ?>">
            <p>
                <?= $value ?>
            </p>
        </div>
        <?php
    }
}