<?php
namespace CarRived;

/**
 * A rule set that calculates a heuristic value as the sum of each value
 * determined by each rule.
 */
class RuleSet
{
    protected $rules;

    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
    }

    public function heuristic(Edmunds\VehicleStyle $vehicle)
    {
        return array_reduce($this->rules, function ($carry, $item) use ($vehicle) {
            return $carry + $item->heuristic($vehicle);
        }, 0);
    }
}
