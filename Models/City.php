<?php

namespace Modules\Country\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\SyncTranslations;

class City extends Model
{
    use Translatable, SyncTranslations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_country__cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zip_code'
    ];

    /**
     * Attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = [
        'name',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}