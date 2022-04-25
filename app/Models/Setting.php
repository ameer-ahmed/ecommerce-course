<?php

namespace EcommerceCourse\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;

    protected $fillable = ['key', 'is_translatable', 'plain_value'];
    protected $casts = [
        'is_translatable' => 'boolean',
    ];
    protected $translatedAttributes = ['value'];
    protected $with = ['translations'];

    /// SEEDING METHODS
    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    private static function set($key, $value)
    {
        if ($key === 'translatable') {
            return static::setTranslatableSettings($value);
        } elseif (is_array($value)) {
            $value = json_encode($value);
        }
        return static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
    }

    private static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            static::updateOrCreate(['key' => $key], [
                'is_translatable' => true,
                'value' => $value,
            ]);
        }
    }

}
