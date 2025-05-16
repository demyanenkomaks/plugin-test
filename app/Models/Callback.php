<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Maksde\Support\Formation\TemporalFormat;

/**
 * @property int $id Идентификатор записи
 * @property string $name Имя пользователя (max: 255)
 * @property string|null $phone Телефон пользователя (max: 255)
 * @property string|null $email Адрес электронной почты
 * @property string|null $text Текст
 * @property string|null $html Html
 * @property Carbon|null $date Дата
 * @property string|null $time Время
 * @property Carbon|null $datetime Дата и время
 * @property array|null $list Список дат в формате JSON
 * @property Carbon $created_at Дата создания записи
 * @property Carbon $updated_at Дата обновления записи
 */
class Callback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'text',
        'html',
        'date',
        'time',
        'datetime',
        'list',
    ];

    /**
     * Мутатор для поля list.
     */
    protected function list(): Attribute
    {
        return Attribute::make(
            get: static function ($value) {
                if (empty($value)) {
                    return null;
                }

                return collect(json_decode($value, false, 512, JSON_THROW_ON_ERROR))->map(function ($item) {
                    return [
                        'date' => TemporalFormat::date($item->date),
                        'time' => TemporalFormat::time($item->time),
                        'datetime' => TemporalFormat::datetime($item->datetime),
                    ];
                })->all();
            },
            set: static function ($value) {
                if (is_array($value)) {
                    return json_encode(array_map(static function ($item) {
                        return [
                            'date' => TemporalFormat::date($item['date'] ?? null),
                            'time' => TemporalFormat::time($item['time'] ?? null),
                            'datetime' => TemporalFormat::format($item['datetime'] ?? null, 'Y-m-d H:i:s', config('app.timezone')),
                        ];
                    }, $value), JSON_THROW_ON_ERROR);
                }

                return null;
            }
        );
    }

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'datetime' => 'datetime',
            'list' => 'array',
        ];
    }
}
