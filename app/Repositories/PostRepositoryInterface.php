<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
   public function store(int $user_id, string $content): int;
}