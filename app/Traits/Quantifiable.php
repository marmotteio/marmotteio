<?php

namespace App\Traits;

trait Quantifiable
{
    public function totalQuantityLeft()
    {
        $totalCheckedOut = 0;

        foreach ($this->quantifiableRelationships as $relationship) {
            $totalCheckedOut += $this->$relationship()->wherePivot('checked_in_at', null)->count();
        }

        return $this->quantity - $totalCheckedOut;
    }

    public function totalNotCheckedInFor(?array $relationships = null)
    {
        $totalCheckedOut = 0;

        $relationships = $relationships ?? $this->quantifiableRelationships;

        foreach ($relationships as $relationship) {
            $totalCheckedOut += $this->$relationship()->wherePivot('checked_in_at', null)->count();
        }

        return $totalCheckedOut;
    }

    public function getTotalAvailabilityLabel()
    {
        $left = $this->totalQuantityLeft();

        return "$left out of $this->quantity";
    }
}
