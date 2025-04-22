<?php

namespace App\Http\Resources;

use App\Models\Callback;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Maksde\Support\Formation\TemporalFormat;

/**
 * Resource для форматирования данных сущности "Обратная связь".
 *
 * @mixin Callback
 */
class CallbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'date' => TemporalFormat::date($this->date),
            'time' => TemporalFormat::time($this->time),
            'datetime' => TemporalFormat::datetime($this->datetime),
            'list' => $this->formatList($this->list),
            'created_at' => TemporalFormat::datetime($this->created_at),
            'updated_at' => TemporalFormat::datetime($this->updated_at),
        ];
    }

    /**
     * Форматирует список дат для вывода.
     */
    protected function formatList(?array $list): array
    {
        if (empty($list)) {
            return [];
        }

        return collect($list)->map(function ($item) {
            return [
                'date' => ! empty($item['date']) ? TemporalFormat::date($item['date']) : null,
                'time' => ! empty($item['time']) ? TemporalFormat::time($item['time'], config('app.timezone')) : null,
                'datetime' => ! empty($item['datetime']) ? TemporalFormat::datetime($item['datetime'], config('app.timezone')) : null,
            ];
        })->toArray();
    }
}
