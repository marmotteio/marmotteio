<?php

namespace App\Filament\Widgets;

use App\Models\HardwarePerson;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class HardwareCheckinsCheckouts extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static string $chartId = 'anotherBlogPostsChart';

    protected static ?int $sort = -22;

    protected static ?string $pollingInterval = null;

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Hardware Check-Ins & Check-Outs';

    protected function rangeAreaData($checkoutField)
    {
        $dates = collect();
        for ($daysBackwards = 0; $daysBackwards < 30; $daysBackwards++) {
            $dates->push(Carbon::now()->subDays($daysBackwards)->format('Y-m-d'));
        }

        // Your database query here to get the data, ensuring to match the date format
        $checkouts = HardwarePerson::selectRaw('DATE('.$checkoutField.') as checkout_date, count(*) as count')
            ->where($checkoutField, '>=', $dates->last())
            ->groupBy(DB::raw('DATE('.$checkoutField.')'))
            ->pluck('count', 'checkout_date')
            ->all();

        $finalResult = [];

        // Looping through each day and creating the final result array
        foreach ($dates as $date) {
            $formattedResult = [
                'x' => Carbon::parse($date)->format('m/d'),
                'y' => $checkouts[$date] ?? 0, // Using null coalesce to ensure we get 0 if no data exists for the day
            ];
            $finalResult[] = $formattedResult;
        }

        $finalResult = collect($finalResult)->reverse()->values()->all();

        return $finalResult;
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'line',
                'height' => 170,
                'width' => '100%',
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'grid' => [
                'show' => false,
            ],
            'series' => [
                [
                    'name' => 'Check-ins',
                    'data' => $this->rangeAreaData('checked_in_at'),
                ],
                [
                    'name' => 'Check-outs',
                    'data' => $this->rangeAreaData('checked_out_at'),
                ],
            ],
            'xaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'show' => false,
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#AAB434', '#34AAB4'],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
        ];
    }
}
