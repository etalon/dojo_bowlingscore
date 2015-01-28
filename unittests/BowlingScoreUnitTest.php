<?php

require_once("../Classes/BowlingScoreCalculator.php");

class BowlingScoreUnitTest extends PHPUnit_Framework_TestCase
{

    public function testOnlyStrikes()
    {

        $bsc = new BowlingScoreCalculator();
        $bsc->AddRolls(array(10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10));

        $this->assertEquals(300, $bsc->currentScore());

    }

    public function testTenTimesNinty()
    {

        $bsc = new BowlingScoreCalculator();
        $bsc->AddRolls(array(9, 0, 9, 0, 9, 0, 9, 0, 9, 0, 9, 0, 9, 0, 9, 0, 9, 0, 9, 0));

        $this->assertEquals(90, $bsc->currentScore());

    }

    public function testTwentyOneTimesFive()
    {

        $bsc = new BowlingScoreCalculator();
        $bsc->AddRolls(array(5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5));

        $this->assertEquals(150, $bsc->currentScore());

    }

    public function testOnlySparesAndFive(){

        $bsc = new BowlingScoreCalculator();
        $bsc->AddRolls(array(0,10,0,10,0,10,0,10,0,10,0,10,0,10,0,10,0,10,0,10,5));

        $this->assertEquals(105, $bsc->currentScore());

    }

}
