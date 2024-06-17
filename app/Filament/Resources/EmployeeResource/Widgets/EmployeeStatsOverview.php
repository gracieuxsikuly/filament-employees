<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Employee;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tout les employees', Employee::all()->count())
            ->description('Nombre total d\'employés')
            ->descriptionIcon('heroicon-m-arrow-trending-up',IconPosition::Before)
            ->color('success'),
        Stat::make('Bounce rate', '21%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
        Stat::make('Average time on page', '3:12')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('warning'),
        ];
    }
}
