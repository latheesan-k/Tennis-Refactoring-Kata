<?php

namespace src;

class Player
{
    private $name;
    private $points;
    private $result = '';

    public function __construct($name, $points = 0)
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

    public function incrementPoints()
    {
        $this->points++;
    }
}