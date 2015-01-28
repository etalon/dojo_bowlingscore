<?php

class BowlingFrame
{

    private $scoreRoll1;
    private $scoreRoll2;

    public function AddRoll($p_RollScore)
    {
        if (!$this->tryAddRoll($p_RollScore)) {
            throw new exception("Score konnte nicht zum Frame hinzugefügt werden!");
        }
    }

    protected function tryAddRoll($p_RollScore)
    {

        if (!isset($this->scoreRoll1)) {
            $this->scoreRoll1 = $p_RollScore;
            return true;
        }

        if (!isset($this->scoreRoll2)) {
            $this->scoreRoll2 = $p_RollScore;
            return true;
        }

        return false;

    }

    public function ScoreRoll1()
    {
        return $this->scoreRoll2;
    }

    public function ScoreRoll2()
    {
        return $this->scoreRoll2;
    }

    public function IsStrike()
    {
        return ($this->scoreRoll1 == 10);
    }

    public function IsSpare()
    {
        return (($this->scoreRoll1 + $this->scoreRoll2) == 10 and $this->scoreRoll1 != 10);
    }

    public function IsFrameComplete()
    {
        if ($this->IsStrike() or (isset($this->scoreRoll1) and isset($this->scoreRoll2))) {
            return true;
        } else {
            return false;
        }

    }

}