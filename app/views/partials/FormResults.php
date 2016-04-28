<?php
namespace App\views\partials;

class FormResults {
    public static function render($coins) {
        ?>
        <div class="result">
            <div class="result-inner">
                <?php
                foreach ($coins as $key => $value) {
                    ?>
                    <div class="coin <?= $key ?>">
                        <?= $value ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}