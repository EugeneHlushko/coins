<?php
/*
 * Actual splitting into coins going on here with validated amount
 */
namespace App\validators;

class SplitAmount {
    //  £2, £1, 50p, 20p, 2p and 1p coins

    private function splitTwo($amount, $val2, $val1) {
        if ($amount == 1) return [$val1 => 1];

        if ($amount % 2 == 0) {
            return [$val2 => $amount / 2];
        } else {
            return [$val2 => ($amount-1) / 2, $val1 => '1'];
        }
    }

    private function splitCoins($c) {
        $coinsArray = [];
        $leftover = $c;
        if ($leftover >= 50) {
            if ($leftover == 50) {
                return ['pny50' => 1];
            } else {
                $coinsArray['pny50'] = 1;
                $leftover = $leftover - 50;
            }
        }

        if ($leftover >= 20) {
            if ($leftover == 20) {
                $coinsArray['pny20'] = 1;
            } else {
                $coinsArray['pny20'] = floor($leftover/20);
                $leftover = $leftover - ($coinsArray['pny20']*20);
            }
        }

        if ($leftover > 0) {
            $lastcoins = $this->splitTwo($leftover, 'pny2', 'pny1');
            $coinsArray = array_merge($coinsArray, $lastcoins);
        }

        return $coinsArray;
    }

    public function doSplit($state) {
        // if we have pounds, split them
        $p = $state['pounds'];
        $c = $state['pence'];
        $finalCoins = [];
        if ($p > 0) {
            $finalCoins = $this->splitTwo($p, 'pnd2', 'pnd1');
        }

        if ($c > 0) {
            $coinsArray = $this->splitCoins($c);
            $finalCoins = array_merge($finalCoins, $coinsArray);
        }

        return $finalCoins;
    }
}