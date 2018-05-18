<?php

namespace Modules\Country\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Admin\Traits\SyncTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    use Translatable, SyncTranslations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'netcore_country__countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'eea',
        'code',
        'capital',
        'is_active',
        'calling_code',
    ];

    /**
     * Attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = [
        'name',
        'full_name',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /** -------------------- Relations -------------------- */

    /**
     * Country belongs to the currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Country has many cities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /** -------------------- Scopes -------------------- */

    /**
     * Scope a query to only include active countries.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /** -------------------- Accessors -------------------- */

    /**
     * Return URL to flag.
     *
     * @return string
     */
    public function getFlagUrlAttribute(): string
    {
        return asset('assets/country/flags/' . $this->code . '.png');
    }
}