<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackResource\Pages;
use App\Models\Callback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Maksde\Helpers\Filament\Forms\Components;
use Maksde\Helpers\Filament\Tables\Columns;
use Maksde\Helpers\Filament\Tables\Filters\CreateUpdateFilters;
use Maksde\Support\Contracts\Validation\EmailValidate;

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
                ...Components\CreateUpdatePlaceholders::make(),

                Components\StringCharCount::make('name', 'Имя')
                    ->required(),

                Components\StringCharCount::make('email', 'Почта')
                    ->rules([new EmailValidate]),

                Components\PhoneForm::make('phone', 'Телефон'),

                Components\DateForm::make('date', 'Дата'),

                Components\TimeForm::make('time', 'Время'),

                Components\DateTimeForm::make('datetime', 'Дата и время'),

                Components\TextCharCount::make('text', 'Текст')
                    ->rows(10),

                Components\HtmlCharCount::make('html', 'Html'),

                Forms\Components\Repeater::make('list')
                    ->label('Список дат')
                    ->schema([
                        Components\DateForm::make('date', 'Дата'),

                        Components\TimeForm::make('time', 'Время'),

                        Components\DateTimeForm::make('datetime', 'Дата и время'),
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
