<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $code
 * @property string $url
 * @property int $clicks
 * @property Carbon $created_at
 */
final class Link extends Model
{
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        $model = parent::resolveRouteBinding($value, $field);

        if(is_null($model)) {
            return self::query()->firstWhere('code', $value);
        }

        return $model;
    }

    public function handleGo(): void
    {
        $this->increment('clicks');
    }
}
