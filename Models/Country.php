<?php

namespace Modules\Country\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'netcore_country__countries';

    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'capital', 'full_name', 'calling_code', 'eea'
    ];

    /**
     * Disable created_at and updated_at timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Return a relation with Currency
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
