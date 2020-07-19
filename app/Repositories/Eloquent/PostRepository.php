<?php
namespace App\Repositories\Eloquent;  

use App\Repositories\PostRepositoryInterface; 
use Illuminate\Support\Collection;

use App\Post;

class PostRepository implements PostRepositoryInterface 
{  
    /**
     * Create a post
     * 
     * @param int $user_id = User's ID
     * @param string $content = Content of the post
     */
    public function store(int $user_id, string $content): int
    {
        $post = new Post;
        $post->user_id = $user_id;
        $post->content = $content;
        $result = $post->save();

        if($result){
            return $result;
        } else {
            return 0;
        }
    }

    /**
     * Pull all posts order by date created
     */
    public function all(): collection
    {
        // return Post::orderBy('created_at','desc')->with('user', 'postlike', 'comments')->get();
        return Post::orderBy('created_at','desc')->with('user', 'postlike')->with(['comments' => function ($comment) {
            $comment->with('user', 'replies');
        }])->get();
    }

    /**
     * Pull all posts by specific user_id
     * @param int $id = User's ID
     */
    public function getByUserId(int $id): collection
    {
        // return Post::where('user_id', '=', $id)->orderBy('created_at','desc')->with('user', 'postlike', 'comments')->get();

        return Post::where('user_id', '=', $id)->orderBy('created_at','desc')->with('user', 'postlike')->with(['comments' => function ($comment) {
            $comment->with('user', 'replies');
        }])->get();
    }

    // public function postLikeCheck(int $post_id, int $user_id): collection
    // {
    //     return Post::where('user_id', '=', $id)->orderBy('created_at','desc')->with('user')->get();
    // }

}