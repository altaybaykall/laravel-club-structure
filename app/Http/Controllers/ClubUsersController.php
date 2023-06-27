<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\User;
use App\Models\UserClubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    public  function userJoinClub(Clubs $club) {
        $user = Auth::user()->id;
        $hasPivot = User::where('id', $user)->whereHas('club', function ($q) use ($club) {
            $q->where('club_id', $club->id);
        })->exists();

        if(!$hasPivot) {
            $club->user()->attach($user);
        }
        return back();
    }
    public  function  userLeftClub(Clubs $id) {
        $user = Auth::user();
        $id->user()->detach($user->id);
        $user->removeRole('clubMember');
        return redirect('/club');

    }



}
