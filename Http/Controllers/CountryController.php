<?php

namespace Modules\Country\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Modules\Country\Models\Country;
use Modules\Country\Models\Currency;
use Modules\Country\Http\Requests\CountryRequest;

class CountryController extends Controller
{
    use ValidatesRequests;

    /**
     * Display listing of countries.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('country::countries.index', [
            'countries' => Country::withCount('cities')->get(),
        ]);
    }

    /**
     * Display country edit form.
     *
     * @param \Modules\Country\Models\Country $country
     * @return \Illuminate\View\View
     */
    public function edit(Country $country): View
    {
        $currencies = Currency::get()->mapWithKeys(function (Currency $currency) {
            return [$currency->id => $currency->name . ' - ' . $currency->symbol];
        })->toArray();

        return view('country::countries.edit', compact('country', 'currencies'));
    }

    /**
     * Update country data in the database.
     *
     * @param \Modules\Country\Models\Country $country
     * @param \Modules\Country\Http\Requests\CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Country $country, CountryRequest $request): RedirectResponse
    {
        $country->update($request->all());
        $country->updateTranslations($request->input('translations', []));

        return redirect()->back()->withSuccess('Country successfully updated!');
    }

    /**
     * Toggle country active state.
     *
     * @param \Modules\Country\Models\Country $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleActiveState(Country $country): JsonResponse
    {
        $country->update([
            'is_active' => !$country->is_active,
        ]);

        return response()->json([
            'message' => 'Country successfully ' . ($country->is_active ? 'enabled' : 'disabled'),
        ]);
    }
}