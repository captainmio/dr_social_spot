<?php
namespace App\Repositories\Eloquent;  

use App\Repositories\PostLikeRepositoryInterface; 
use Illuminate\Support\Collection;

use App\PostLike;

class PostLikeRepository implements PostLikeRepositoryInterface 
{  
    /**
     * Check if post has already been like by the user(by user_id)
     * @param int $post_id = ID of the post
     * @param int $user_id = ID of the uset
     */
    public function postLikeCheck(int $post_id, int $user_id): collection
    {
        return PostLike::where([
            ['user_id', '=', $user_id],
            ['post_id', '=', $post_id]
        ])->get();
    }

    /**
     * like the post
     * @param int $post_id = ID of the post
     * @param int $user_id = ID of the uset
     */
    public function likePost(int $post_id, int $user_id): bool
    {
        $like = new PostLike;
        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $result = $like->save();



        if($result){
            return $result;
        } else {
            return 0;
        }
    }


    /**
     * remove the like to the post
     * @param int $post_id = ID of the post
     * @param int $user_id = ID of the uset
     */
    public function removeLikePost(int $post_id, int $user_id): bool
    {
        $result =  PostLike::where([
            ['user_id', '=', $user_id],
            ['post_id', '=', $post_id]
        ])->delete();

        if($result){
            return $result;
        } else {
            return 0;
        }
    }

}