<?php
namespace App\views;

class Error {
    public static function render() {
        ?>
        <div class="error">
            <p>Error occured!</p>
            <p>
                Please go to our <a href="/">Homepage</a>
            </p>
        </div>
        <?php
    }
}