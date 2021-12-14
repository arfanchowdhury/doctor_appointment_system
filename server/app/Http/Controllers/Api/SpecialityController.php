<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Speciality\StoreSpecialityRequest;
use App\Http\Requests\Speciality\UpdateSpecialityRequest;
use App\Models\Speciality;

class SpecialityController extends Controller
{

    public function index()
    {
        $specialities = Speciality::all();

        return response()->json([
            'data'   => $specialities,
            'status' => sizeof($specialities) ? true : false,
        ]);
    }

    public function store(StoreSpecialityRequest $request)
    {
        $speciality = Speciality::create($request->validated());

        return response()->json([
            'status' => $speciality ? true : false,
        ]);
    }

    public function update(UpdateSpecialityRequest $request, Speciality $speciality)
    {
        $status = $speciality->update($request->validated());

        return response()->json([
            'status' => $status,
        ]);
    }
}
