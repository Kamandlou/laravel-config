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
        return self::where('key', $key)->first('value')->value ?? '';
    }

    public static function allConfig(string ...$columns): array
    {
        $query = self::query();
        foreach ($columns as $column){
            $query = $query->orWhere(function ($q) use ($column) {
                return $q->where('key', $column);
            });
        }
        $results = $query->get(['key', 'value'])->groupBy('key')->toArray();
        $values = [];
        foreach ($results as $key => $configs) {
            if (count($configs) > 1) {
                foreach ($configs as $config) {
                    $values[$key][] = $config['value'];
                }
            } else {
                $values[$key] = $configs[0]['value'];
            }
        }
        return $values;
    }
}
