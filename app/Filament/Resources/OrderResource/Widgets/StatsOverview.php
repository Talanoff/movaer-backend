<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use App\Models\User;
use Cache;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Flowframe\Trend\Trend;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        [$thisWeekRegistrations, $totalRegistrations] = $this->weeklyRegistrations();
        [$thisWeekOrders, $totalOrders] = $this->weeklyOrders();

        return [
            Card::make('Weekly registrations', $thisWeekRegistrations->sum->aggregate)
                ->description(abs($totalRegistrations) . ($totalRegistrations >= 0 ? ' increase' : ' decrease'))
                ->descriptionIcon($totalRegistrations >= 0 ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down')
                ->chart($thisWeekRegistrations->map->aggregate->all())
                ->color($totalRegistrations > 0 ? 'success' : 'warning'),
            Card::make('Weekly orders', $thisWeekOrders->sum->aggregate)
                ->description(abs($totalOrders) . ($totalOrders >= 0 ? ' increase' : ' decrease'))
                ->descriptionIcon($totalOrders >= 0 ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down')
                ->chart($thisWeekOrders->map->aggregate->all())
                ->color($totalRegistrations > 0 ? 'success' : 'warning'),
        ];
    }

    private function weeklyRegistrations(): array
    {
        $lastWeekRegistrations = Cache::remember('registrations:weekly:last', now()->endOfWeek(), static function () {
            return Trend::model(User::class)
                ->between(
                    start: now()->subWeek()->startOfWeek(),
                    end: now()->subWeek()->endOfWeek(),
                )
                ->perMonth()
                ->count();
        });

        $thisWeekRegistrations = Trend::model(User::class)
            ->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek(),
            )
            ->perDay()
            ->count();

        $total = $thisWeekRegistrations->sum->aggregate - $lastWeekRegistrations->first()->aggregate;

        return [$thisWeekRegistrations, $total];
    }

    private function weeklyOrders(): array
    {
        $lastWeekOrders = Cache::remember('orders:weekly:last', now()->endOfWeek(), static function () {
            return Trend::model(Order::class)
                ->between(
                    start: now()->subWeek()->startOfWeek(),
                    end: now()->subWeek()->endOfWeek(),
                )
                ->perMonth()
                ->count();
        });

        $thisWeekOrders = Trend::model(Order::class)
            ->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek(),
            )
            ->perDay()
            ->count();

        $total = $thisWeekOrders->sum->aggregate - $lastWeekOrders->first()->aggregate;

        return [$thisWeekOrders, $total];
    }
}
