<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function store(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:4',
            'permissions' => 'array',
        ]);

        // 2️⃣ Create User (Staff)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3️⃣ Insert Permissions
        if ($request->has('permissions')) {
            foreach ($request->permissions as $perm) {

                UserPermission::create([
                    'user_id'   => $user->id,
                    'module_id' => $perm['module_id'],

                    'create'    => $perm['create'] ?? 0,
                    'view'      => $perm['view'] ?? 0,
                    'update'    => $perm['update'] ?? 0,
                    'delete'    => $perm['delete'] ?? 0,
                ]);
            }
        }

        // 4️⃣ Response
        return response()->json([
            'message' => 'Staff created successfully!',
            'user'    => $user
        ]);
    }
}
