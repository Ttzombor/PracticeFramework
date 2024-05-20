<?php

interface DistanceInterface
{
    public function getDistance();
}

class CarDistance implements DistanceInterface
{
    public function getDistance()
    {
        return 100;
    }
}

class BusDistance implements DistanceInterface
{
   public $name = "Bus";
    public function getDistance()
    {
        return 200;
    }
}

class PedestrianDistance implements DistanceInterface
{
    public $name = "Pedestrian";
    public function getDistance()
    {
        return 150;
    }
}

class Distance implements DistanceInterface
{
    public function __construct(private ?DistanceInterface $distance = null)
    {
    }

    public function setDistance(DistanceInterface $class)
    {
        $this->distance = $class;
    }
    public function getDistance()
    {
        if (!$this->distance) {
            return "not set";
        }
        return $this->distance->getDistance();
    }
}

$distance = new Distance();

echo "Empty distance " . $distance->getDistance() . PHP_EOL;


$distance->setDistance(new BusDistance());

echo "Bus distance " .  $distance->getDistance() . PHP_EOL;

$distance->setDistance(new PedestrianDistance());

echo "Pedestreian distance " .  $distance->getDistance() . PHP_EOL;
