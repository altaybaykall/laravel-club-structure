<?php

namespace App\Policies;

use App\Models\ClubEvents;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClubEventPolicy
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
    public function view(User $user, ClubEvents $clubEvents): bool
    {
        // Kulüp üyesi etkinliğe katılmış mı katılmamış mı kontrolü
        if ($user->can('clubEvent-join')) {
           $userInClub = $clubEvents->user()->where('user_id', $user->id)->first();
            if (!$userInClub) {
                return true;
            }
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
    public function update(User $user, ClubEvents $clubEvents): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ClubEvents $clubEvents): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClubEvents $clubEvents): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClubEvents $clubEvents): bool
    {
        //
    }
}
