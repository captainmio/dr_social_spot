<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface PostLikeRepositoryInterface
{
    public function postLikeCheck(int $post_id, int $user_id): collection;

    public function likePost(int $post_id, int $user_id): bool;

    public function removeLikePost(int $post_id, int $user_id): bool;
}