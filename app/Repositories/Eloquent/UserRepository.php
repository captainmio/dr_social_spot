<?php
namespace App\Repositories\Eloquent;  

use App\Repositories\UserRepositoryInterface; 
use Illuminate\Support\Collection;

use App\User;

class UserRepository implements UserRepositoryInterface 
{  
    /**
     * Get all Registered User
     */
    public function allExceptLoggedInUser(int $user_id): Collection
    {
        return User::where('id', '!=', $user_id)->get();    
    }

}