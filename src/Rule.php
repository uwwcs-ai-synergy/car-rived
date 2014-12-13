<?php
namespace CarRived;

/**
 * Base rule class.
 */
abstract class Rule
{
    abstract public function heuristic(Edmunds\VehicleStyle $vehicle);
}
