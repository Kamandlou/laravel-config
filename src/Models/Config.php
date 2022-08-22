<?php

namespace Kamandlou\LaravelConfig\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $guarded = ['id'];
    protected $table = 'configs';

    public static function getConfig(string $key): array
    {
        return self::where('key', $key)->pluck('value')->toArray();
    }

    public static function firstConfig(string $key): string
    {
        return self::where('key', $key)->first('value')->value;
    }
}
