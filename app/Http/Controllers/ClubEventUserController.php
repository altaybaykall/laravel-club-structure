<?php

namespace App\Http\Controllers;

use App\Models\ClubEvents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubEventUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:clubMember']);

    }
    public  function  eventUserJoin(ClubEvents $event) {
        $user = Auth::user()->id;
        $hasPivot = User::where('id', $user)->whereHas('clubEvent', function ($q) use ($event) {
            $q->where('event_id', $event->id);
        })->exists();
        if(!$hasPivot) {
            $event->user()->attach($user);
        }
        return back();
    }

    public  function  eventUserLeft(ClubEvents $event) {
        $user = Auth::user()->id;
        $event->user()->detach($user);
        return back();

    }
}
