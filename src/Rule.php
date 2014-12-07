<?php
namespace CarRived;

abstract class Rule
{
    abstract public function heuristic(Edmunds\VehicleStyle $vehicle);
}
