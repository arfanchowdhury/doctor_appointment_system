<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function makeAdmin(UpdateRoleRequest $request, $id)
    {
        $user   = User::find($id);
        $status = $user->update($request->validated());

        return response()->json([
            'status' => $status,
        ]);
    }
}
