<?php

namespace src\Utils;

class ScoreUtil
{
    private $scoreMap = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    public function toScoreName($score)
    {
        if (isset($this->scoreMap[$score])) {
            return $this->scoreMap[$score];
        }
    }
}
