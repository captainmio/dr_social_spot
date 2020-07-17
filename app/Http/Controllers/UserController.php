<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        $user_id = Auth::user()->id;

        $friends = $this->userRepository->allExceptLoggedInUser($user_id);

        return response()->json($friends);

    }
}
