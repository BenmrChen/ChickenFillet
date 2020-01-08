<?php

namespace App\Policies;

use App\ChickenFilletShop;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChickenFilletShopPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        // 昨天新建的
        if ($user->permission== 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any chicken fillet shops.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the chicken fillet shop.
     *
     * @param  \App\User  $user
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return mixed
     */
    public function view(User $user, ChickenFilletShop $chickenFilletShop)
    {
        //
    }

    /**
     * Determine whether the user can create chicken fillet shops.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the chicken fillet shop.
     *
     * @param  \App\User  $user
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return mixed
     */
    public function update(User $user, ChickenFilletShop $chickenFilletShop)
    {
        if ($user->id === $chickenFilletShop->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the chicken fillet shop.
     *
     * @param  \App\User  $user
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return mixed
     */
    public function delete(User $user, ChickenFilletShop $chickenFilletShop)
    {
        if ($user->id === $chickenFilletShop->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the chicken fillet shop.
     *
     * @param  \App\User  $user
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return mixed
     */
    public function restore(User $user, ChickenFilletShop $chickenFilletShop)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the chicken fillet shop.
     *
     * @param  \App\User  $user
     * @param  \App\ChickenFilletShop  $chickenFilletShop
     * @return mixed
     */
    public function forceDelete(User $user, ChickenFilletShop $chickenFilletShop)
    {
        //
    }
}
