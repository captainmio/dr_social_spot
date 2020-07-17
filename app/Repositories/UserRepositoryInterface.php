<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
   public function allExceptLoggedInUser(int $user_id): Collection;
}