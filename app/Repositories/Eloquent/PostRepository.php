<?php
namespace App\Repositories\Eloquent;  

use App\Repositories\PostRepositoryInterface; 
use Illuminate\Support\Collection;

use App\Post;

class PostRepository implements PostRepositoryInterface 
{  
    /**
     * Create a post
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
            return ['error' => 'Error occured when trying to create post'];
        }
    }

}