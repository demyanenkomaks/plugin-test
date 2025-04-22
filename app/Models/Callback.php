<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id Идентификатор записи
 * @property string $name Имя пользователя (max: 255)
 * @property string|null $phone Телефон пользователя (max: 255)
 * @property string|null $email Адрес электронной почты
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
        'date',
        'time',
        'datetime',
        'list',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'datetime' => 'datetime',
        'list' => 'array',
    ];

    /**
     * Мутатор для поля list.
     *
     * @param  array|null  $value
     * @return void
     */
    public function setListAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['list'] = json_encode(array_map(static function ($item) {
                return [
                    'date' => ! empty($item['date']) ? Carbon::parse($item['date'])->format('Y-m-d') : null,
                    'time' => ! empty($item['time']) ? Carbon::parse($item['time'])->format('H:i:s') : null,
                    'datetime' => ! empty($item['datetime']) ? Carbon::parse($item['datetime'])->setTimezone('UTC')->toDateTimeString() : null,
                ];
            }, $value), JSON_THROW_ON_ERROR);
        } else {
            $this->attributes['list'] = null;
        }
    }
}
