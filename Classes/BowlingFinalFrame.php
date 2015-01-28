<?php

class BowlingFinalFrame extends BowlingFrame
{

    private $scoreRoll3;
    private $scoreRoll4;

    public function AddRoll($p_RollScore)
    {

        if (!parent::tryAddRoll($p_RollScore)) {

            if (!isset($this->scoreRoll3)) {
                $this->scoreRoll3 = $p_RollScore;
                return true;
            }

            if (!isset($this->scoreRoll4)) {
                $this->scoreRoll4 = $p_RollScore;
                return true;
            }

            throw new exception("Score konnte nicht zum Frame hinzugefügt werden!");

        }

    }

    public function IsFrameComplete()
    {

        if (!parent::IsFrameComplete()) {
            return false;
        }

        if ($this->HasThirdRoll()) {
            return false;
        }

        if ($this->HasFourthRoll()) {
            return false;
        }

        return true;

    }

    private function HasThirdRoll()
    {
        return ($this->IsSpare() or $this->IsStrike());
    }

    private function HasFourthRoll()
    {
        return ($this->HasThirdRoll() and $this->scoreRoll3 == 10);
    }

}