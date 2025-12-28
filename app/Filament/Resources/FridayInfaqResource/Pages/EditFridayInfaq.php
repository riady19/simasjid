<?php

namespace App\Filament\Resources\FridayInfaqResource\Pages;

use App\Filament\Resources\FridayInfaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFridayInfaq extends EditRecord
{
    protected static string $resource = FridayInfaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
