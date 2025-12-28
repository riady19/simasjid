<?php

namespace App\Filament\Resources\FridayInfaqResource\Pages;

use App\Filament\Resources\FridayInfaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFridayInfaqs extends ListRecords
{
    protected static string $resource = FridayInfaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
