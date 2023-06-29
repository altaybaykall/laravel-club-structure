<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubEventRequest;
use App\Models\ClubEvents;
use App\Models\Clubs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClubEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:clubEvent-create|clubEvent-delete|clubEvent-join|clubEvent-edit']);
    }
    public  function  addClubEvent(ClubEventRequest $request) {

        $n = (new ClubEvents())->create([
            'event_title' => $request['event_title'],
            'event_content' => $request['event_content'],
            'event_start_date' => $request['event_start_date'],
            'event_finish_date' => $request['event_finish_date'],
            'event_owner' => Auth::user()->name,
            'club_id' => $request->id,
            'user_limit' => $request['user_limit'],
        ]);
        return back();
    }
    public function editClubEvent(ClubEvents $event)
    {
        return view('clubs/edit-club-event', compact('event'));
    }
    public function editClubEventSave(ClubEventRequest $request, ClubEvents $event) {
        $event->update([
            'event_title' => $request['event_title'],
            'event_content' => $request['event_content'],
            'event_start_date' => $request['event_start_date'],
            'event_finish_date' => $request['event_finish_date'],

        ]);
        return redirect('/club');
    }
    public function deleteClubEvent(ClubEvents $event) {
         $event->delete();
         return back();
    }

}
