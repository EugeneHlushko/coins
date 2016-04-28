<?php
namespace App\views;

class Ajax {

    public function render() {
        $validator = new \App\validators\DetectAmount();
        if (isset($_POST['value'])) {
            $val = htmlspecialchars($_POST['value'], ENT_QUOTES, 'utf-8');
            $result = $validator->detect($val);
        }
        $response = [
            'status' => $result['status']
        ];

        if (isset($result['error'])) {
            $errorRenderer = new \App\views\partials\FormError();
            $errors = '';
            foreach ($result['error'] as $key => $value) {
                $errors .= $errorRenderer->render($key, $value);
            }
            $response['errors'] = $errors;
        }

        if (isset($result['status']) && $result['status'] == 'valid') {
            $coins = new \App\views\partials\FormResults();
            $response['coins'] = $coins->render($result['coins']);
        }

        return json_encode($response);
    }
}