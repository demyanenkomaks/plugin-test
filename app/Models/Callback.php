<?php

declare(strict_types=1);

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
 * @property array<int, array{date: string|null, time: string|null, datetime: string|null}>|null $list Список дат в формате JSON
 * @property Carbon $created_at Дата создания записи
 * @property Carbon $updated_at Дата обновления записи
 */
class Callback extends Model
{
    /** @use HasFactory<\Database\Factories\CallbackFactory> */
    use HasFactory;

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
     *
     * @return Attribute<array<int, array{date: string|null, time: string|null, datetime: string|null}>|null, string|null>
     */
    protected function list(): Attribute
    {
        $appTz = config('app.timezone');

        return Attribute::make(
            get: static function (?string $value) use ($appTz): ?array {
                if (empty($value)) {
                    return null;
                }

                $raw = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
                if (! is_array($raw)) {
                    return null;
                }

                return array_map(static function ($item) use ($appTz) {
                    return [
                        'date' => $item['date'] ?? null,
                        'time' => TemporalFormat::forOutput($item['time'] ?? null, 'time', $appTz, 'H:i'),
                        'datetime' => TemporalFormat::forOutput($item['datetime'] ?? null, 'datetime', $appTz, 'Y-m-d H:i:s'),
                    ];
                }, $raw);
            },
            set: static function ($value) use ($appTz) {
                if (! is_array($value)) {
                    return null;
                }

                return json_encode(array_map(static function ($item) use ($appTz) {
                    return [
                        'date' => TemporalFormat::forStorage($item['date'] ?? null, 'date', $appTz),
                        'time' => TemporalFormat::forStorage($item['time'] ?? null, 'time', $appTz),
                        'datetime' => TemporalFormat::forStorage($item['datetime'] ?? null, 'datetime', $appTz),
                    ];
                }, $value), JSON_THROW_ON_ERROR);
            }
        );
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'datetime' => 'datetime',
        ];
    }
}
