<?php
namespace Modules\Country\Observers;

class CountryObserver {

    /**
     * Listen to Country saved event
     */
    public function saved()
    {
        $this->flush();
    }

    /**
     * Listen to Country deleted event
     */
    public function deleted()
    {
        $this->flush();
    }

    /**
     * Flush Country cache
     *
     * @throws \Exception
     */
    private function flush()
    {
        cache()->forget(config('netcore.module-country.cache_key') . 'countries');
    }
}
