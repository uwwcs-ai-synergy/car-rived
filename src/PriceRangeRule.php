<?php
namespace CarRived;

final class PriceRangeRule extends Rule
{
    private $minPrice;
    private $maxPrice;

    public function __construct($minPrice, $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function heuristic(Edmunds\VehicleStyle $vehicle)
    {
        $price = 0;

        if (isset($vehicle->price->baseMSRP)) {
            $price = $vehicle->price->baseMSRP;
        } elseif (isset($vehicle->price->baseInvoice)) {
            $price = $vehicle->price->baseInvoice;
        } elseif (isset($vehicle->price->usedTmvRetail)) {
            $price = $vehicle->price->usedTmvRetail;
        }

        // calculate the radius of the range and the midpoint
        $radius = ($this->maxPrice - $this->minPrice) / 2;
        $midpoint = $this->minPrice + $radius;

        // calculate heuristic value
        return (pow($midpoint - $price, 2) / ($radius * 2)) - ($radius / 2);
    }
}
