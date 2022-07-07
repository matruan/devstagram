<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //

    public function store(User $user, Request $resquest)
    {
        $user->followers()->attach( auth()->user()->id );

        return back();
    }
}
