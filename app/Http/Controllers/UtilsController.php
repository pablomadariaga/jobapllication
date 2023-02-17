<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    /**
     * Get countries via ajax
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountries(Request $request)
    {
        $search = $request->search ?? '';
        $search = Str::contains($search, '+') ? Str::replace('+', '', $search) : $search;
        $countries = Country::searchOptions($search)->selected($request)->get();
        return response()->json($countries);
    }

    /**
     * Get states via ajax
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStates(Request $request)
    {
        $search = $request->search ?? '';
        $byId = $request->byId ?? '';
        $states = State::getSystemStates()->whereHas('cities')->searchOptions($search, null, true, 2, $byId)->get();
        return response()->json($states);
    }

    /**
     * Get cities via ajax
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities(Request $request)
    {
        $search = $request->search ?? '';
        $byId = $request->byId ?? '';
        $state = $request->present_state ?? $request->permanent_state;
        $cities = City::where('state_id', $state)
            ->getSystemCities()->searchOptions($search, null, true, 2, $byId)->get();
        return response()->json($cities);
    }
}
