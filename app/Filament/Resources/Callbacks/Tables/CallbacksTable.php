<?php

declare(strict_types=1);

namespace App\Filament\Resources\Callbacks\Tables;

use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use Maksde\Helpers\Filament\Resources\Tables\Columns;
use Maksde\Helpers\Filament\Resources\Tables\Filters\CreateUpdateFilters;

class CallbacksTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Columns\IdColumn::make(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),

                Columns\PhoneColumn::make('phone', 'Телефон'),
                Columns\EmailColumn::make('email', 'Почта'),
                Columns\DateColumn::make('date', 'Дата'),
                Columns\TimeColumn::make('time', 'Время'),
                Columns\TimestampColumn::make('datetime', 'Дата и время'),

                ...Columns\CreateUpdateColumns::make(),
            ])
            ->filters([
                ...CreateUpdateFilters::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
