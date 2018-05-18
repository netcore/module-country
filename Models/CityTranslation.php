<?php

namespace Modules\Country\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_country__city_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'locale',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}