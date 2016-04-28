<?php
namespace App\views;

class Index {

    private function setState() {
        $validator = new \App\validators\DetectAmount();
        if (isset($_POST['value'])) {
            $val = htmlspecialchars($_POST['value'], ENT_QUOTES, 'utf-8');
            $result = $validator->detect($val);
            $result['value'] = $val;
        } else {
            $result = [
                'value' => ''
            ];
        }
        return $result;
    }

    public function render() {
        $result = self::setState();
        ob_start();
        ?>
        <form class="form" action="/" method="POST">
            <div class="form-row">
                <label for="value">
                    Money amount:
                </label>
                <input type="text" id="value" name="value" value="<?= $result['value'] ?>">
            </div>
            <div id="errors">
                <?php
                if (isset($result['error'])) {
                    $errorRenderer = new \App\views\partials\FormError();
                    foreach ($result['error'] as $key => $value) {
                        echo $errorRenderer->render($key, $value);
                    }
                }
                ?>
            </div>
            <div class="form-row">
                <button type="submit" class="form-button">Split into coins</button>
            </div>
        </form>
        <div id="results">
            <?php
            if (isset($result['status']) && $result['status'] == 'valid') {
                $coins = new \App\views\partials\FormResults();
                echo $coins->render($result['coins']);
            }
            ?>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}