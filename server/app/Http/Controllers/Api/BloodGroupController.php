<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;

class BloodGroupController extends Controller
{
    public function index()
    {
        $blood_groups = BloodGroup::all();

        return response()->json([
            'data' => $blood_groups
        ]);
    }
}
