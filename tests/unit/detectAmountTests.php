<?php
namespace Tests\unit;

class DetectAmountTests extends \PHPUnit_Framework_TestCase
{
    public function testDetectorValidity()
    {
        $detector = new \App\validators\DetectAmount();
        $arrayOfTestedValues = [
            '4',
            '85',
            '197p',
            '2p',
            '1.87',
            '£1.23',
            '£2',
            '£10',
            '£1.87',
            '£1p',
            '£1.p',
            '001.41p',
            '4.235p',
            '£1.257422457p'
        ];
        $arrayOfRejectedValues = [
            '',
            '1x',
            '£1x.0p',
            '£p',
            '0',
            '00000'
        ];
        // test positive
        foreach ($arrayOfTestedValues as $value) {
            $result = $detector->detect($value);
            $this->assertTrue($result['status'] === 'valid');
        }

        //test rejected
        foreach ($arrayOfRejectedValues as $value) {
            $result = $detector->detect($value);
            echo 'value was: '.$value;
            print_r($result);
            $this->assertTrue($result['status'] === 'invalid');
        }
    }
}