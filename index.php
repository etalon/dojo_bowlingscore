<?php

require_once("Classes/BowlingScoreCalculator.php");

$bsc = new BowlingScoreCalculator();

for ($i = 0; $i < 12; $i++) {
    $bsc->AddRoll(10);
    print $bsc->currentScore() . "\n";
}
