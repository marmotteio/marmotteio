<?php

namespace App\Filament\Widgets;

use App\Models\ComponentHardware;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class WidgetThree extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static string $chartId = 'blogPostsChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Components Check-Outs';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        // Get the last 6 months in a human-readable format.
        $months = collect()->times(6, function ($number) {
            return now()->subMonths($number - 1)->format('F');
        })->reverse()->values()->all();

        // Get the count of consumables checked out per month for the last 6 months.
        $consumableData = collect()->times(6, function ($number) {
            return ComponentHardware::whereMonth('checked_out_at', now()->subMonths($number - 1)->month)
                ->whereYear('checked_out_at', now()->subMonths($number - 1)->year)
                ->count();
        })->reverse()->values()->all();

        return [
            'chart' => [
                'type' => 'area',
                'height' => 170,
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'grid' => [
                'show' => false,
            ],
            'series' => [
                [
                    'name' => 'Checked Out Components',
                    'data' => $consumableData,
                ],
            ],
            'xaxis' => [
                'categories' => $months,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#34b487'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
