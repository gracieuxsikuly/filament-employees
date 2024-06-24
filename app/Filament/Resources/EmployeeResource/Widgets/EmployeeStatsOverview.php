<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Country;
use App\Models\Employee;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $cd=Country::where('country_code','CD')->withCount('employees')->first();
        $us=Country::where('country_code', 'US')->withCount('employees')->first();
        return [
            Stat::make('Tout les employees', Employee::all()->count())
            ->description('Nombre total d\'employés')
            ->descriptionIcon('heroicon-m-arrow-trending-up',IconPosition::Before)
            ->color('success'),
        Stat::make('CD Employees ', $cd? $cd->employees_count:0)
            ->description('Nombre d\'employés en RDC')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
        Stat::make('US Employees', $us? $us->employees_count:0)
            ->description('Nombre d\'employés aux USA')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('warning'),
        ];
    }

}
