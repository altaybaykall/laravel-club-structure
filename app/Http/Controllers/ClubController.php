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
use Spatie\Permission\Models\Permission;


class ClubController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function getClubs()
    {
        $user = Auth::user();
        //$user->assignRole('Super-Admin');

        $myclubs = Auth::user()->club()->whereNot('role','0')->get();
            $clubs = Clubs::with('user')->get();
        return view('clubs/clubs', compact('clubs', 'myclubs'));
    }

    public function getClubDetail(Clubs $club)
    {
        // Kulübe üye mi  kontrol ve detaya giriş izni
        $isMember = Gate::inspect('view', $club);
        if ($isMember->allowed()) {
            $approved = $club->user()->where('role','1')->get();
            $events = $club->events()->where('event_start_date', '>=', now())->withCount('user')->get();
            return view('clubs/detail-club', compact('club','approved','events'));
        }
        return back();

    }
}
