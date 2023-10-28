<?php

namespace App\Models;

use App\Traits\HasTeam;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasTeam, \Sushi\Sushi;

    public function getRows(): array
    {
        $records = [];

        $consumables = Consumable::all();
        foreach ($consumables as $consumable) {
            if ($consumable->totalQuantityLeft() <= $consumable->threshold) {
                $records[] = [
                    'record_id' => $consumable->id,
                    'record' => 'Consumable',
                    'record_name' => $consumable->name,
                    'record_url' => 'consumables',
                    'threshold' => 'less than or equal to '.$consumable->threshold,
                    'quantity_left' => $consumable->totalQuantityLeft(),
                    'quantity' => $consumable->quantity,
                ];
            }
        }

        $licences = Licence::all();
        foreach ($licences as $licence) {
            if ($licence->totalQuantityLeft() <= $licence->threshold) {
                $records[] = [
                    'record_id' => $licence->id,
                    'record' => 'Licence',
                    'record_name' => $licence->name,
                    'record_url' => 'licences',
                    'threshold' => 'less than or equal to '.$licence->threshold,
                    'quantity_left' => $licence->totalQuantityLeft(),
                    'quantity' => $licence->quantity,
                ];
            }
        }

        $components = Component::all();
        foreach ($components as $component) {
            if ($component->totalQuantityLeft() <= $component->threshold) {
                $records[] = [
                    'record_id' => $component->id,
                    'record' => 'Component',
                    'record_name' => $component->name,
                    'record_url' => 'components',
                    'threshold' => 'less than or equal to '.$component->threshold,
                    'quantity_left' => $component->totalQuantityLeft(),
                    'quantity' => $component->quantity,
                ];
            }
        }

        return $records;
    }
}
