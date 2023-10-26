<?php

namespace App\Filament\Widgets;

use App\Models\ConsumablePerson;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class BlogPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    protected static string $chartId = 'blogPostsChart';

    /**
     * Widget Title
     */
    protected static ?string $heading = 'Consumables Consumption';

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
            return ConsumablePerson::whereMonth('checked_out_at', now()->subMonths($number - 1)->month)
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
                    'name' => 'Checked Out Consumables',
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
            'colors' => ['#AAB434'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
