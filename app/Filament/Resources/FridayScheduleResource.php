<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FridayScheduleResource\Pages;
use App\Filament\Resources\FridayScheduleResource\RelationManagers;
use App\Models\FridaySchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FridayScheduleResource extends Resource
{
    protected static ?string $model = FridaySchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Section::make('Petugas')
                    ->schema([
                        Forms\Components\TextInput::make('khotib')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('khotib_photo')
                            ->image()
                            ->directory('friday-schedules'),
                        Forms\Components\TextInput::make('imam')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('imam_photo')
                            ->image()
                            ->directory('friday-schedules'),
                        Forms\Components\TextInput::make('bilal')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('bilal_photo')
                            ->image()
                            ->directory('friday-schedules'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('khotib')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('khotib_photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('imam')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('imam_photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('bilal')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('bilal_photo')
                    ->circular(),
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
            'index' => Pages\ListFridaySchedules::route('/'),
            'create' => Pages\CreateFridaySchedule::route('/create'),
            'edit' => Pages\EditFridaySchedule::route('/{record}/edit'),
        ];
    }
}
