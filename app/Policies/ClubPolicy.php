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

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Clubs $club): bool
    {
        if ($user->hasRole('Super-Admin')) {
            return true;
        }
        if (!is_null($club->user->firstWhere('id',$user->id))) {
          return $club->user->firstWhere('id',$user->id)->pivot->user_id == $user->id ;
        }

       return false;


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
        if ($user->hasRole('Super-Admin')) {
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
