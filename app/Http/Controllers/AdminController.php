<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('admin.dashboard', [
            'users' => User::all(),
        ]);
    }

    public function block(User $user)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $user->is_banned = true;
        $user->save();
        return redirect()->back();
    }
}
