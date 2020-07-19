<?php
namespace App\Repositories;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function store(int $post_id, int $parent_id, int $user_id, $body): int;

    public function findComments(int $post_id, int $parent_id): collection;
}