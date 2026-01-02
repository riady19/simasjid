<?php

namespace App\Filament\Resources\ZakatResource\Pages;

use App\Filament\Resources\ZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZakats extends ListRecords
{
    protected static string $resource = ZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('pdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->url(route('zakat-report.pdf'))
                ->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }
}
