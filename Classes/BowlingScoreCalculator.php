<?php

require_once("BowlingFrame.php");
require_once("BowlingFinalFrame.php");

class BowlingScoreCalculator
{

    CONST MAXFRAMES = 10;

    private $rollMultiplicator = array();
    private $frames = array();
    private $currentScore = 0;
    private $currentFrameNumber = 0;
    private $currentRollNumber = 0;

    function __construct()
    {
        $this->initCurrentFrame();
        $this->rollMultiplicator = array_fill(0, 22, 1);
    }

    public function AddRoll($p_RollScore)
    {

        if (!$this->HasRolls()) {
            throw new exception("Keine weiteren Würfe erlaubt!");
        }

        // Wenn der Frame komplett ist, müssen wir auf den nächsten gehen
        if ($this->currentFrame()->IsFrameComplete()) {

            // Jetzt prüfen ob Bonuspunkte notwendig werden (im letzten Frame gibt es keine Bonuspunkte)
            if ($this->currentFrameNumber < self::MAXFRAMES - 1) {

                if ($this->currentFrame()->IsStrike()) {
                    $this->multiplyNextTwoRolls();
                } elseif ($this->currentFrame()->IsSpare()) {
                    $this->multiplyNextRoll();
                }
            }

            $this->currentFrameNumber++;
            $this->initCurrentFrame();
        }

        // Wir fügen den Wurf zum Frame hinzu
        $this->currentFrame()->AddRoll($p_RollScore);

        // Punktestand erneuern inkl. Multiplikator
        $this->currentScore += $p_RollScore * $this->rollMultiplicator[$this->currentRollNumber];
        $this->currentRollNumber++;

    }

    public function HasRolls()
    {

        if (sizeof($this->frames) < self::MAXFRAMES) {
            return true;
        }

        return !$this->frames[self::MAXFRAMES - 1]->IsFrameComplete();

    }

    public function AddRolls($p_RollScores)
    {
        foreach ($p_RollScores as $rollScore) {
            $this->AddRoll($rollScore);
        }
    }

    public function CurrentScore()
    {
        return $this->currentScore;
    }

    private function currentFrame()
    {
        return $this->frames[$this->currentFrameNumber];
    }

    private function initCurrentFrame()
    {
        if ($this->currentFrameNumber < self::MAXFRAMES - 1) {
            $this->frames[$this->currentFrameNumber] = new BowlingFrame();
        } else {
            $this->frames[$this->currentFrameNumber] = new BowlingFinalFrame();
        }
    }

    private function multiplyNextRoll()
    {
        $this->rollMultiplicator[$this->currentRollNumber + 0]++;
    }

    private function multiplyNextTwoRolls()
    {
        $this->multiplyNextRoll();
        $this->rollMultiplicator[$this->currentRollNumber + 1]++;
    }

}