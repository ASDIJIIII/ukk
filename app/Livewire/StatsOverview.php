<?php

namespace App\Livewire;

use App\Models\Loan;
use App\Models\Tool;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Stok Alat', Tool::sum('stock')),
            Stat::make('Menunggu', Loan::where('status', 'menunggu')->count()),
            Stat::make('Dipinjam', Loan::where('status', 'dipinjam')->count()),
        ];
    }
}