<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Models\Clubs;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ClubAdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Super-Admin|Editor']);
    }

    public function getCreateClub()
    {
        $users = User::all();
        return view('clubs/create-club', compact('users'));
    }

    public function addClub(ClubRequest $request): RedirectResponse
    {
        //Kulüp oluşturma
        $img = substr($request['club_name'], 0, 8) . '-' . uniqid() . '.png';
        $imgData = Image::make($request['file'])->encode('png');
        $newClub = (new Clubs())->create([
            'club_name' => $request['club_name'],
            'club_content' => $request['club_content'],
            'club_slug' => $request['club_slug'],
            'club_department' => $request['club_department'],
            'club_logo' => $img,
            'club_manager' => $request['club_manager'],
        ]);
        Storage::put('public/club_logos/' . $img, $imgData);

        //Seçilen Manager Kulübe üye yapılıp yetki veriliyor
        $user =User::where('id',$request['club_manager'])->first();
        $user->assignRole('clubManager');
        $newClub->user()->attach($user->id);
        $newClub->user()->where('user_id', $user->id)->update(['role' => 2]);
        return redirect('/club');
    }

    public function deleteClub(Clubs $club)
    {
        $club->delete();
        return redirect('/club');
    }
}
