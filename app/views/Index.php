<?php
namespace App\views;

class Index {

    private function setState() {
        $validator = new \App\validators\DetectAmount();
        if (isset($_POST['value'])) {
            $result = $validator->detect($_POST['value']);
            $result['value'] = (isset($_POST['value'])) ? $_POST['value'] : '';
        } else {
            $result = [
                'value' => ''
            ];
        }
        return $result;
    }

    public function render() {
        $result = self::setState();
        ?>
        <form class="form" action="/" method="POST">
            <div class="form-row">
                <label for="value">
                    Money amount:
                </label>
                <input type="text" id="value" name="value" value="<?= $result['value'] ?>">
            </div>
            <?php
            if (isset($result['error'])) {
                $errorRenderer = new \App\views\partials\FormError();
                foreach ($result['error'] as $key => $value) {
                    $errorRenderer->render($key, $value);
                }
            }
            ?>
            <div class="form-row">
                <button type="submit" class="form-button">Split into coins</button>
            </div>
        </form>
        <?php
        if (isset($result['status']) && $result['status'] == 'valid') {
            $coins = new \App\views\partials\FormResults();
            $coins->render($result['coins']);
        }
        ?>
        <?php
    }
}