<?php
namespace App\views\partials;

class FormResults {
    public static function render($coins) {
        ob_start();
        ?>
        <div class="result">
            <div class="result-inner">
                <div class="close">
                    Hide results
                </div>
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
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}