<?php

namespace App\Http\Resources;

use App\Models\Callback;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Maksde\Support\Formation\TemporalFormat;

/**
 * @mixin Callback
 */
class CallbackResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'date' => TemporalFormat::forOutput($this->date, 'date'),
            'time' => TemporalFormat::forOutput($this->time, 'time'),
            'datetime' => TemporalFormat::forOutput($this->datetime, 'datetime'),
            'list' => $this->formatListForApi($this->list),
            'created_at' => TemporalFormat::forOutput($this->created_at, 'datetime'),
            'updated_at' => TemporalFormat::forOutput($this->updated_at, 'datetime'),
        ];
    }

    /**
     * @param  array<int, array{date?: string|null, time?: string|null, datetime?: string|null}>|null  $list
     * @return array<int, array{date: string|null, time: string|null, datetime: string|null}>|null
     */
    private function formatListForApi(?array $list): ?array
    {
        if (! is_array($list)) {
            return null;
        }

        return array_map(function ($item) {
            return [
                'date' => TemporalFormat::forOutput($item['date'] ?? null, 'date'),
                'time' => TemporalFormat::forOutput($item['time'] ?? null, 'time'),
                'datetime' => TemporalFormat::forOutput($item['datetime'] ?? null, 'datetime'),
            ];
        }, $list);
    }
}
