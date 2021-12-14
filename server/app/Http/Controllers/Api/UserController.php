<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{

    public function updateUserProfile(UpdateUserRequest $request, User $user)
    {
        $status = $user->update($request->validated()) ? true : false;

        return response()->json([
            'status' => $status,
        ]);
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        $user   = User::find(Auth()->user()->id);
        $status = $user->update($request->validated()) ? true : false;

        return response()->json([
            'user'   => $user,
            'status' => $status,
        ]);
    }
}
