<?php

namespace src;

class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $points;

    /**
     * @var string
     */
    private $result = '';

    /**
     * Player constructor.
     * @param string $name
     * @param int $points
     */
    public function __construct(string $name, int $points = 0)
    {
        $this->name = $name;
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    public function incrementPoints(): void
    {
        $this->points++;
    }
}
