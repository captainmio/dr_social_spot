<?php
namespace App\Repositories\Eloquent;  

use App\Repositories\CommentRepositoryInterface; 
use Illuminate\Support\Collection;

use App\Comment;

class CommentRepository implements CommentRepositoryInterface 
{  
    /**
     * Add a comment to a post
     * @param int $post_id = ID of the post to where the comment belongs
     * @param int $parent_id = toidentify if this comment is a parent comment or under(reply) a parent comment(its a child comment)
     * @param int $user_id = User's ID
     * @param int $body = content of the comment
     */
    public function store(int $post_id, int $parent_id, int $user_id, $body): int
    {
        $comment = new Comment;
        $comment->post_id = $post_id;
        $comment->user_id = $user_id;
        $comment->parent_id = $parent_id;
        $comment->body = $body;
        $result = $comment->save();

        if($result){
            return $result;
        } else {
            return 0;
        }
    }

    /**
     * Pull comments under a parent_id
     */
    public function findComments(int $post_id, int $parent_id): collection
    {
        return Comment::where([
            ['post_id', '=', $post_id],
            ['parent_id', '=', $parent_id]
        ])->with('user')->get();

    }

}