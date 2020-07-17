<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Repositories\PostRepositoryInterface;

class PostController extends Controller
{

    protected $postRepository;

    /**
     * UserController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function store(Request $request)
    {
        $authuser = Auth::user();

        $user_id = $request->user_id;
        $content = $request->post;

        $post = null;
        // validate if $user_id is equal to current loggedin user to check that the post create is the current loggedin user
        if($user_id === $authuser->id) {

            // check if needed data values are submitted and not null
            if($user_id && $content) {
                
                // create the post
                $post = $this->postRepository->store($user_id, $content);
                return response()->json($post);

            } else {
                return response()->json([
                    'error' => 'Missing values'
                ]);
            } 
            
        } else {
            return response()->json([
                'error' => 'You need to logged-in to do post'
            ]);
        }

        

        // 

        // if()

    }
}
