<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     * 限制用户只能看自己的资料
     */
    public function update(User $currentUser,User $user){
        
        return $currentUser->id === $user->id;
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     * 只能是管理员，并且删除用户的id不是自己才能执行删除用户的操作
     */
    public function destroy(User $currentUser,User $user){
        return $currentUser->is_admin && $currentUser->id !==$user->id;
    }
}
