<?php

namespace App\Policies;

use App\Models\Pay;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserSubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewSubscription(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
                           ->where('collection_status', 'PLAN-PRE-UNI')
                           ->where('estado','ACTIVO')
                           ->first();

        return $subscription ? true : false;
    }

    public function notSubscription(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
                           ->where('collection_status', 'PLAN-PRE-UNI')
                           ->where('estado','ACTIVO')
                           ->first();

        return $subscription ? false : true;
    }
}
