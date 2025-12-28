<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrayerTimeResource\Pages;
use App\Filament\Resources\PrayerTimeResource\RelationManagers;
use App\Models\PrayerTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrayerTimeResource extends Resource
{
    protected static ?string $model = PrayerTime::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('subuh')
                    ->required(),
                Forms\Components\TextInput::make('dzuhur')
                    ->required(),
                Forms\Components\TextInput::make('ashar')
                    ->required(),
                Forms\Components\TextInput::make('maghrib')
                    ->required(),
                Forms\Components\TextInput::make('isya')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subuh')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dzuhur')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ashar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('maghrib')
                    ->searchable(),
                Tables\Columns\TextColumn::make('isya')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrayerTimes::route('/'),
            'create' => Pages\CreatePrayerTime::route('/create'),
            'edit' => Pages\EditPrayerTime::route('/{record}/edit'),
        ];
    }
}
