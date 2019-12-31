<?php

namespace App\Policies;

use App\TravelPackage;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TravelPackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any travel packages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the travel package.
     *
     * @param  \App\User  $user
     * @param  \App\TravelPackage  $travelPackage
     * @return boolean
     */
    public function view(User $user, TravelPackage $travelPackage)
    {
        // if user make a transaction with specified travel package 
        if ($user->transactions()
                 ->where('transaction_status_id', 1)
                 ->where('travel_package_id', $travelPackage->id)
                 ->first()
           ) return true;

        return false;
    }

    /**
     * Determine whether the user can create travel packages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the travel package.
     *
     * @param  \App\User  $user
     * @param  \App\TravelPackage  $travelPackage
     * @return mixed
     */
    public function update(User $user, TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Determine whether the user can delete the travel package.
     *
     * @param  \App\User  $user
     * @param  \App\TravelPackage  $travelPackage
     * @return mixed
     */
    public function delete(User $user, TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Determine whether the user can restore the travel package.
     *
     * @param  \App\User  $user
     * @param  \App\TravelPackage  $travelPackage
     * @return mixed
     */
    public function restore(User $user, TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the travel package.
     *
     * @param  \App\User  $user
     * @param  \App\TravelPackage  $travelPackage
     * @return mixed
     */
    public function forceDelete(User $user, TravelPackage $travelPackage)
    {
        //
    }
}
