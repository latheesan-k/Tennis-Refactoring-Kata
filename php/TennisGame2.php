<?php

use src\Player;
use src\GameScore;
use src\Exceptions\GameException;

class TennisGame2 implements TennisGame
{
    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * @var GameScore
     */
    private $gameScore;

    /**
     * TennisGame2 constructor.
     * @param string $player1Name
     * @param string $player2Name
     */
    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1 = new Player($player1Name);
        $this->player2 = new Player($player2Name);
        $this->gameScore = new GameScore;
    }

    /**
     * @return string
     * @throws GameException
     */
    public function getScore()
    {
        $score = $this->gameScore->calculateScore(
            $this->player1,
            $this->player2
        );

        return $score;
    }

    /**
     * @param $playerName
     */
    public function wonPoint($playerName)
    {
        if ($playerName == $this->player1->getName()) {
            $this->player1->incrementPoints();
        } else {
            $this->player2->incrementPoints();
        }
    }
}
