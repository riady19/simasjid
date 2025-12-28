<?php

namespace App\Filament\Resources\FridayScheduleResource\Pages;

use App\Filament\Resources\FridayScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFridaySchedules extends ListRecords
{
    protected static string $resource = FridayScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
