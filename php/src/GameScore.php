<?php

namespace src;

use src\Utils\ScoreUtil;
use src\Exceptions\GameException;

class GameScore
{
    private const ADVANTAGE_POINTS_THRESHOLD = 3;
    private const EQUAL_POINTS_THRESHOLD = 4;
    private const POINTS_SPREAD_THRESHOLD = 2;

    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * @var ScoreUtil
     */
    private $scoreUtil;

    /**
     * @var string
     */
    private $score = "";

    public function __construct()
    {
        $this->scoreUtil = new ScoreUtil;
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @return string
     * @throws GameException
     */
    public function calculateScore(Player $player1, Player $player2): string
    {
        $this->player1 = $player1;
        $this->player2 = $player2;

        $this->setBothPlayerResults();
        $this->setInitialScore();
        $this->handleEqualPointsScenario();
        $this->handleDeuceScenario();
        $this->handleAdvantageScenario();
        $this->handleGameWonScenario();

        return $this->score;
    }

    private function setBothPlayerResults(): void
    {
        $player1Result = $this->scoreUtil->toScoreName($this->player1->getPoints());
        $this->player1->setResult($player1Result);

        $player2Result = $this->scoreUtil->toScoreName($this->player2->getPoints());
        $this->player2->setResult($player2Result);
    }

    private function setInitialScore(): void
    {
        $this->score = sprintf("%s-%s",
            $this->player1->getResult(),
            $this->player2->getResult()
        );
    }

    private function handleEqualPointsScenario(): void
    {
        if ($this->pointsAreEqual() && $this->player1->getPoints() < self::EQUAL_POINTS_THRESHOLD) {
            $this->score = sprintf("%s-%s",
                $this->scoreUtil->toScoreName($this->player1->getPoints()),
                "All"
            );
        }
    }

    private function handleDeuceScenario(): void
    {
        if ($this->pointsAreEqual() && $this->player1->getPoints() >= self::ADVANTAGE_POINTS_THRESHOLD) {
            $this->score = "Deuce";
        }
    }

    /**
     * @throws GameException
     */
    private function handleAdvantageScenario(): void
    {
        if ($this->isAdvantage()) {
            $this->score = "Advantage " . $this->getLeadingPlayer()->getName();
        }
    }

    /**
     * @throws GameException
     */
    private function handleGameWonScenario(): void
    {
        if ($this->isGameWon()) {
            $this->score = "Win for " . $this->getLeadingPlayer()->getName();
        }
    }

    /**
     * @return bool
     */
    private function pointsAreEqual()
    {
        return ($this->player1->getPoints() == $this->player2->getPoints());
    }

    /**
     * @return bool
     */
    private function isAdvantage()
    {
        $thresholdMet = (
            $this->player1->getPoints() >= self::ADVANTAGE_POINTS_THRESHOLD &&
            $this->player2->getPoints() >= self::ADVANTAGE_POINTS_THRESHOLD
        );

        return (!$this->pointsAreEqual() && $thresholdMet);
    }

    /**
     * @return Player
     * @throws GameException
     */
    private function getLeadingPlayer()
    {
        if ($this->pointsAreEqual()) {
            throw new GameException("There are no leading players. This error should never occur.");
        }

        if ($this->player1->getPoints() > $this->player2->getPoints()) {
            return $this->player1;
        }

        return $this->player2;
    }

    /**
     * @return bool
     * @throws GameException
     */
    private function isGameWon()
    {
        return (
            $this->getPointsSpread() >= self::POINTS_SPREAD_THRESHOLD
            && $this->getLeadingPlayer()->getPoints() >= self::EQUAL_POINTS_THRESHOLD
        );
    }

    /**
     * @return int
     */
    private function getPointsSpread()
    {
        return ((int) abs ($this->player1->getPoints() - $this->player2->getPoints()));
    }
}
