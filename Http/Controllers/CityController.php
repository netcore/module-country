<?php

namespace Modules\Country\Http\Controllers;

use Exception;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;

use Modules\Country\Models\City;
use Modules\Country\Models\Country;
use Modules\Country\Http\Requests\CityRequest;

class CityController extends Controller
{
    /**
     * Display listing of cities.
     *
     * @param \Modules\Country\Models\Country $country
     * @return \Illuminate\View\View
     */
    public function index(Country $country): View
    {
        return view('country::cities.index', compact('country'));
    }

    /**
     * Display city create form.
     *
     * @param \Modules\Country\Models\Country $country
     * @return \Illuminate\View\View
     */
    public function create(Country $country): View
    {
        return view('country::cities.form', compact('country'));
    }

    /**
     * Store city in database.
     *
     * @param \Modules\Country\Models\Country $country
     * @param \Modules\Country\Http\Requests\CityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Country $country, CityRequest $request): RedirectResponse
    {
        $city = $country->cities()->create(
            $request->only('zip_code')
        );

        $city->storeTranslations(
            $request->input('translations', [])
        );

        return redirect()->route('country::countries.cities.edit', [$country, $city])->withSuccess(
            'City successfully created!'
        );
    }

    /**
     * Display city edit form.
     *
     * @param \Modules\Country\Models\Country $country
     * @param \Modules\Country\Models\City $city
     * @return \Illuminate\View\View
     */
    public function edit(Country $country, City $city): View
    {
        return view('country::cities.form', compact('country', 'city'));
    }

    /**
     * Update city in database.
     *
     * @param \Modules\Country\Models\Country $country
     * @param \Modules\Country\Models\City $city
     * @param \Modules\Country\Http\Requests\CityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Country $country, City $city, CityRequest $request): RedirectResponse
    {
        if ($country->id !== $city->country_id) {
            abort(404);
        }

        $city->update(
            $request->only('zip_code')
        );

        $city->updateTranslations(
            $request->input('translations', [])
        );

        return redirect()->back()->withSuccess('City successfully updated');
    }

    /**
     * Delete city from database.
     *
     * @param \Modules\Country\Models\Country $country
     * @param \Modules\Country\Models\City $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Country $country, City $city): RedirectResponse
    {
        if ($country->id !== $city->country_id) {
            abort(404);
        }

        try {
            $city->delete();
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Unable to delete city - ' . $e->getMessage());
        }

        return redirect()->back()->withSuccess('City successfully deleted!');
    }
}