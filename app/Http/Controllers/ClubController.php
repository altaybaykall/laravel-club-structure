<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Models\ClubEvents;
use App\Models\Clubs;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ClubController extends Controller
{

    public function getClubs()
    {


        if(!Auth::check()) {
            $myclubs = [];
        }
        $myclubs = Auth::user()->club;
            $clubs = Clubs::with('user', 'events')->get();

        return view('clubs/clubs', compact('clubs', 'myclubs'));
    }

    public function getClubDetail(Clubs $club)
    {
        $isMember = Gate::inspect('view', $club);
        if ($isMember->allowed()) {

           $pending = $club->user()->where('role','0')->get();
            $approved = $club->user()->where('role','1')->get();
            return view('clubs/detail-club', compact('club','pending','approved'));
        }
        return back();

    }
}
