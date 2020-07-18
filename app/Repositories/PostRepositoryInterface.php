<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
   public function store(int $user_id, string $content): int;

   public function all(): collection;

   public function getByUserId(int $id): collection;

   // public function postLikeCheck(int $post_id, int $user_id): collection;
}