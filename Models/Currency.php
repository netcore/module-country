<?php

namespace Modules\Country\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_country__currencies';

    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'symbol'
    ];

    /**
     * Disable created_at and updated_at timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Return a relation with Country
     *
     * @return BelongsTo
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
