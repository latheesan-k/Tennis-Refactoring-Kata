<?php

namespace src\Utils;

class ScoreUtil
{
    /**
     * @var array
     */
    private $scoreMap = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    /**
     * @param $score
     * @return mixed|string
     */
    public function toScoreName($score)
    {
        if (isset($this->scoreMap[$score])) {
            return $this->scoreMap[$score];
        }

        return '';
    }
}
