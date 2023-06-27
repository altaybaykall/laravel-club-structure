<?php

namespace App\Policies;

use App\Models\Clubs;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;

class ClubPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }


    public function memberCheck(User $user,Clubs $club): bool
    {
        $userInClub = $club->user()->where('user_id', $user->id)->withPivot('role')->first();

        if ($userInClub) {
           return  !$userInClub->pivot->role == '0';
        }

        return true; // Kulübe üye olmayanlar katıl butonunu görebilir
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Clubs $club): bool
    {

        if ($user->hasRole('Super-Admin|Editor')) {
            return true;
        }
        $userInClub = $club->user()->where('user_id', $user->id)->withPivot('role')->first();
        if ($userInClub) {
           return  $userInClub->pivot->user_id == $user->id && !$userInClub->pivot->role == '0';
        }
        return false;
    }

    public function memberLeft(User $user,Clubs $club): bool
    {
            return  $user->id !== $club->club_manager;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Clubs $club): bool
    {
        if ($user->hasRole('Super-Admin|Editor')) {
            return true;
        }

        if ($user->can('clubEvent-create')) {
           return  $user->id === $club->club_manager;
        }
         return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Clubs $clubs): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Clubs $clubs): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Clubs $clubs): bool
    {
        //
    }
}
