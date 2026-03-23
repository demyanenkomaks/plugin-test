<?php

declare(strict_types=1);

namespace App\Filament\Resources\Callbacks\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Maksde\Helpers\Filament\Resources\Schemas\Forms as Schemas;
use Maksde\Support\Contracts\Validation\EmailValidate;

class CallbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Schemas\StringCharCount::make('name', 'Имя')
                    ->required(),

                Schemas\StringCharCount::make('email', 'Почта')
                    ->rules([new EmailValidate]),

                Schemas\PhoneForm::make('phone', 'Телефон'),

                Schemas\DateForm::make('date', 'Дата'),

                Schemas\TimeForm::make('time', 'Время'),

                Schemas\DateTimeForm::make('datetime', 'Дата и время'),

                Schemas\TextCharCount::make('text', 'Текст')
                    ->rows(10),

                Schemas\HtmlCharCount::make('html', 'Html'),

                Forms\Components\Repeater::make('list')
                    ->label('Список дат')
                    ->schema([
                        Schemas\DateForm::make('date', 'Дата'),
                        Schemas\TimeForm::make('time', 'Время'),
                        Schemas\DateTimeForm::make('datetime', 'Дата и время'),
                    ])
                    ->columnSpan('full')
                    ->columns(3)
                    ->defaultItems(1)
                    ->addActionLabel('Добавить дату'),
            ]);
    }
}
