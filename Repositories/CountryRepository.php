<?php

namespace Modules\Country\Repositories;

use Modules\Country\Models\Country;

class CountryRepository
{
    /**
     * List of countries
     *
     * @var mixed
     */
    protected $countries;

    /**
     * Key for caching countries
     *
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $cacheKey;

    /**
     * CountryRepository constructor
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->cacheKey = config('netcore.module-country.cache_key');
        $this->countries = cache()->rememberForever($this->cacheKey . 'countries', function () {
            return Country::active()->with('currency')->get();
        });
    }

    /**
     * Return a list of countries
     *
     * @return mixed
     */
    public function all()
    {
        return $this->countries;
    }

    /**
     * Return country by its code
     *
     * @param string $code
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->countries->where('code', $code)->first();
    }

    /**
     * Return country list for select menu (id => name)
     *
     * @return mixed
     */
    public function getSelectList()
    {
        return $this->countries->pluck('name', 'id');
    }
}
