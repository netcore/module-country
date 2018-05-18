<?php

namespace Modules\Country\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_country__currencies';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'code',
        'name',
        'symbol',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /** -------------------- Relations -------------------- */

    /**
     * Currency has many countries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
