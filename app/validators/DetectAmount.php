<?php
/*
 * This Class will do basic detection of money amount entered by user, and check validity.
 * If not valid will return object with error
 */
namespace App\validators;

class DetectAmount
{
    /**
     * @param  string $string
     * @return object
     */
    private function isBasicValid($string) {
        if (preg_match('/^(£)?([0-9]+)([.])?([0-9]+)?([p])?(?![^ ])/', $string)) {
            return $this->isPounds($string, []);
        } else {
            return [
                'error' => [
                    'notValid' => 'Please type in an amount in Pounds or Pennies'
                ]
            ];
        }
    }

    /**
     * @param  string $string
     * @param  object $state
     * @return object
     */
    private function isPounds($string, $state) {
        $firstChar = mb_substr($string, 0, 1, 'utf-8');
        $nextString = ($firstChar == '£')
            ? str_replace($firstChar, '', $string)
            : $string;
        return $this->isDecimal($nextString, $state);
    }

    /**
     * @param  string $string
     * @param  object $state
     * @return object
     */
    private function isDecimal($string, $state) {
        if (strpos($string, ".")) {
            // so we have a point, this might be decimal like 2.15 or mistype like 2.2.
            if (substr_count($string, '.') == 1) {
                $state['isDecimal'] = true;
            } else {
                $state['error']['dotErrorCount'] = 'Too many dots, please check what you have typed';
            }
        }

        if (!isset($state['error'])) {
            return $this->isPenny($string, $state);
        } else {
            return $state;
        }
    }

    /**
     * @param  string $string
     * @param  object $state
     * @return object
     */
    private function isPenny($string, $state) {
        $nextString = (substr($string, -1) == 'p')
            ? str_replace('p', '', $string)
            : $string;
        return $this->getNumber($nextString, $state);
    }

    /**
     * @param  string $string
     * @param  object $state
     * @return object
     */
    private function getNumber($string, $state) {
        $amount = +$string;

        if (isset($state['isDecimal'])) {
            $temp = explode('.', $amount);
            $pounds = $temp[0];
            // cover up for cases £1.p
            $coins = (isset($temp[1])) ? $temp[1] : 0;
            if (count_chars($coins) > 2) {
                $coins = round(substr($coins, 0,2).'.'.substr($coins, 2));
            }
        } else {
            // here we might have 482164271 of pennys, lets break that into pounds
            if ($amount > 100) {
                $pounds = substr($amount, 0, -2);
                $coins = substr($amount, -2);
            } else if ($amount == 100) {
                $pounds = 1;
                $coins = 0;
            } else {
                $pounds = 0;
                $coins = $amount;
            }
        }

        if ($pounds == 0 && $coins == 0) {
            $state['error']['zeroDivision'] = 'Cannot divide zero amount...';
        } else {
            $state['pounds'] = $pounds;
            $state['pence'] = $coins;
        }

        return $state;
    }

    /**
     * @param  string $string
     * @return object
     */
    public function detect($string)
    {
        $result = self::isBasicValid($string);
        if (!isset($result['error'])) {
            $Splitter = new \App\validators\SplitAmount();
            $coins = $Splitter->doSplit($result);
            return ['status' => 'valid', 'coins' => $coins];
        } else {
            return [
                'status' => 'invalid',
                'error' => $result['error']
            ];
        }
    }

}