<?php

namespace App\Filament\Resources\PrayerTimeResource\Pages;

use App\Filament\Resources\PrayerTimeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrayerTimes extends ListRecords
{
    protected static string $resource = PrayerTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
