<?php

namespace App\Filament\Resources\FridayScheduleResource\Pages;

use App\Filament\Resources\FridayScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFridaySchedule extends EditRecord
{
    protected static string $resource = FridayScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
