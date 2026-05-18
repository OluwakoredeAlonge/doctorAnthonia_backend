<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, string $default = ''): string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function set(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function bulk(array $keys): array
    {
        $defaults = array_fill_keys($keys, '');
        $stored   = static::whereIn('key', $keys)->pluck('value', 'key')->toArray();
        return array_merge($defaults, $stored);
    }
}
