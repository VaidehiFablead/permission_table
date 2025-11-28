<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function create()
    {
        $modules = UserPermission::all();  // get sidebar modules for permission table
        return view('staff.create', compact('modules'));
    }
}
