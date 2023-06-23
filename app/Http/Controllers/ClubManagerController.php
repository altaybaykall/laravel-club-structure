<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Models\Clubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ClubManagerController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth',['role:Super-Admin|Editor',]);
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
}
