<?php
namespace CarRived;

/**
 * Rule that calculates a heuristic value based on a vehicle's age.
 */
final class AgeRule extends Rule
{
    private $minYear;

    public function __construct($minYear)
    {
        $this->minYear = $minYear;
    }

    public function heuristic(Edmunds\VehicleStyle $vehicle)
    {
        return pow(($this->minYear - $vehicle->getModelYear()->year) / 4, 3);
    }
}
