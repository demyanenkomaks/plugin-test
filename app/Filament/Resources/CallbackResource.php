<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackResource\Pages;
use App\Models\Callback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Maksde\Helpers\Filament\Forms\Components\CreateUpdatePlaceholders;
use Maksde\Helpers\Filament\Forms\Components\DateForm;
use Maksde\Helpers\Filament\Forms\Components\DateTimeForm;
use Maksde\Helpers\Filament\Forms\Components\PhoneForm;
use Maksde\Helpers\Filament\Forms\Components\TimeForm;
use Maksde\Helpers\Filament\Tables\Columns;
use Maksde\Helpers\Filament\Tables\Filters\CreateUpdateFilters;

class CallbackResource extends Resource
{
    protected static ?string $model = Callback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $modelLabel = 'Обратная связь';

    protected static ?string $pluralModelLabel = 'Обратная связь';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...CreateUpdatePlaceholders::make(),

                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),

                PhoneForm::make('phone', 'Телефон'),

                Forms\Components\TextInput::make('email')
                    ->label('Почта')
                    ->maxLength(255)
                    ->rules(['email:filter']),

                DateForm::make('date', 'Дата'),

                TimeForm::make('time', 'Время'),

                DateTimeForm::make('datetime', 'Дата и время'),

                Forms\Components\Repeater::make('list')
                    ->label('Список дат')
                    ->schema([
                        DateForm::make('date', 'Дата'),

                        TimeForm::make('time', 'Время'),

                        DateTimeForm::make('datetime', 'Дата и время'),
                    ])
                    ->columnSpan('full')
                    ->columns(3)
                    ->defaultItems(1)
                    ->addActionLabel('Добавить дату'),
            ]);
    }

    public static function table(Table $table): Table
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListCallbacks::route('/'),
            'create' => Pages\CreateCallback::route('/create'),
            'edit' => Pages\EditCallback::route('/{record}/edit'),
        ];
    }
}
