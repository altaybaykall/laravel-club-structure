<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Models\Clubs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ClubManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Super-Admin|Editor|clubManager']);
    }
    public function editClub(Clubs $id)
    {
        $club = Clubs::find($id)->first();
        return view('clubs/edit-club', compact('club'));
    }

    public function editSaveClub(ClubRequest $request, Clubs $club)
    {

        $img = $club->club_logo;

        $club->update([
            'club_name' => $request['club_name'],
            'club_content' => $request['club_content'],
            'club_slug' => $request['club_slug'],
            'club_department' => $request['club_department'],
            'club_logo' => $img,
        ]);
        if ($request->has('file')) {
            $imgData = Image::make($request['file'])->encode('png');
            Storage::put('public/club_logos/' . $img, $imgData);
        }
        return redirect('/club');
    }

    public  function  getClubManage(Clubs $club) {

        $isMember = Gate::inspect('view', $club);
        if ($isMember->allowed()) {
            $pending = $club->user()->where('role','0')->get();
            $approved = $club->user()->where('role','1')->get()->except('user_id',Auth::user()->id);
            return view('clubs/manage-club', compact('club','pending','approved'));
        }
        return back();

    }

    public  function userAccept($id,Clubs $clubId) {
        $user =User::where('id',$id)->first();
        $clubId->user()->where('user_id', $user->id)->update(['role' => 1]);
        $user->assignRole('clubMember');
        return back();
    }


    public  function userDeny($id,Clubs $clubId) {
        $user =User::where('id',$id)->first();
        $clubId->user()->where('user_id', $user->id)->delete();
        return back();
    }
}
