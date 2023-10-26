<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\HasUniqueIdentifier;
use App\Traits\Tenantable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depreciation extends Model
{
    use HasFactory, HasTeam, HasUniqueIdentifier, Tenantable;

    protected $fillable = [
        'hardware_id',
        'method',
        'purchase_date',
        'purchase_price',
        'residual_value',
        'useful_life_years',
        'depreciation_expense',
        'accumulated_depreciation',
        'current_book_value',
        'team_id',
        'files',
        'notes',
        'qr_code',
    ];

    protected $casts = [
        'files' => 'array',
        'purchase_date' => 'datetime',
    ];

    public function hardware(): BelongsTo
    {
        return $this->belongsTo(Hardware::class);
    }

    public function calculateDepreciationExpense($periodUnitsProduced = null)
    {
        switch ($this->method) {
            case 'straight_line':
                return $this->straightLineDepreciation();
            case 'double_declining':
                return $this->doubleDecliningBalanceDepreciation();
            case 'units_of_production':
                return $this->unitsOfProductionDepreciation($periodUnitsProduced);
            default:
                throw new \Exception("Unsupported depreciation method: $this->method");
        }
    }

    public function straightLineDepreciation()
    {
        return ($this->purchase_price - $this->residual_value) / ($this->useful_life_years); // Monthly depreciation
    }

    public function doubleDecliningBalanceDepreciation()
    {
        $bookValue = $this->purchase_price - $this->accumulated_depreciation;
        $depreciationRate = (1 / $this->useful_life_years) * 2; // Double declining rate

        return $bookValue * $depreciationRate;
    }

    protected function unitsOfProductionDepreciation($periodUnitsProduced)
    {
        if ($periodUnitsProduced === null) {
            throw new \Exception('Units produced in the period must be provided for Units of Production method');
        }

        $perUnitDepreciation = ($this->purchase_price - $this->residual_value) / $this->total_expected_units; // Total expected units should be a column in your table

        return $perUnitDepreciation * $periodUnitsProduced;
    }

    public function calculateAccumulatedDepreciation($toDate = null)
    {
        $toDate = $toDate ? Carbon::parse($toDate) : now();
        $monthsPassed = $this->purchase_date->diffInMonths($toDate);

        // Ensure that we don't calculate for a period before the purchase date
        if ($monthsPassed < 0) {
            return 0;
        }

        switch ($this->method) {
            case 'straight_line':
                return $this->straightLineAccumulatedDepreciation($monthsPassed);
            case 'double_declining':
                return $this->doubleDecliningAccumulatedDepreciation($monthsPassed);
            case 'units_of_production':
                // Additional logic/data might be needed here for accurate calculations
                throw new \Exception("Accumulated depreciation for 'units_of_production' may require additional logic");
            default:
                throw new \Exception("Unsupported depreciation method: $this->method");
        }
    }

    protected function straightLineAccumulatedDepreciation($monthsPassed)
    {
        $monthlyDepreciation = $this->straightLineDepreciation();

        return $monthlyDepreciation * min($monthsPassed, $this->useful_life_years);
    }

    protected function doubleDecliningAccumulatedDepreciation($monthsPassed)
    {
        // Accumulated depreciation in double declining might not be linear
        // You might need period-to-period calculation for accuracy
        // Alternatively, you can store and update it periodically in the database

        $accumulatedDepreciation = 0;
        $bookValue = $this->purchase_price;
        $depreciationRate = (1 / $this->useful_life_years) * 2;

        for ($i = 0; $i < min($monthsPassed, $this->useful_life_years); $i++) {
            $monthlyDepreciation = $bookValue * $depreciationRate;
            $accumulatedDepreciation += $monthlyDepreciation;
            $bookValue -= $monthlyDepreciation;
        }

        return $accumulatedDepreciation;
    }

    public function calculateCurrentBookValue($toDate = null)
    {
        $toDate = $toDate ? Carbon::parse($toDate) : now();
        $accumulatedDepreciation = $this->calculateAccumulatedDepreciation($toDate);

        // Ensuring book value does not drop below the residual value
        return max($this->purchase_price - $accumulatedDepreciation, $this->residual_value);
    }

    public function getDepreciationEndPeriod()
    {
        return $this->purchase_date->addYears($this->useful_life_years);
    }

    public function getDepreciationSchedule($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $schedule = collect();
        while ($startDate->lessThanOrEqualTo($endDate)) {
            $nextDate = (clone $startDate)->addMonth();

            // For variable depreciation methods like DDB, you might want to store values rather than recalculate.
            $schedule->push([
                'period_start' => $startDate->toDateString(),
                'period_end' => $nextDate->toDateString(),
                'depreciation' => $this->getDepreciationForPeriod($startDate, $nextDate),
            ]);

            $startDate = $nextDate;
        }

        return $schedule;
    }
}
