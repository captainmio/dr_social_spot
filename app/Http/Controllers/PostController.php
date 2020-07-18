<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostLikeRepositoryInterface;

class PostController extends Controller
{

    protected $postRepository;
    protected $postLikeRepository;

    /**
     * UserController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param PostLikeRepositoryInterface $postLikeRepository
     */
    public function __construct(PostRepositoryInterface $postRepository, PostLikeRepositoryInterface $postLikeRepository)
    {
        $this->postRepository = $postRepository;
        $this->postLikeRepository = $postLikeRepository;
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
                
                if($post) {
                    return response()->json($post);
                } else {
                    return response()->json(['error' => 'Error occured when trying to create post']);
                }
                

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

    }

    public function index(Request $request)
    {
        $user_id = (int) $request->id;
        
        // validate $user_id
        if($user_id) {
            $posts = $this->postRepository->getByUserId($user_id);

            return response()->json($posts);

        } else {
            $posts = $this->postRepository->all();

            return response()->json($posts);

        }
        

        return response()->json([
            'id' => $user_id
        ]);
    }

    public function likeAPost(Request $request) {
        $post_id = $request->post_id;
        $authuser = Auth::user();

        // check if post is already save in the post_like table
        $like_check = $this->postLikeRepository->postLikeCheck($post_id, $authuser->id);

        if($like_check->isEmpty()) {
            // like the post
            $likeresult = $this->postLikeRepository->likePost($post_id, $authuser->id);

            if($likeresult) {
                return response()->json(['like' => true]);
            } else {
                return response()->json(['error' => 'Error occured when trying to like a post']);
            }
        } else {
            // remove like to the post
            $likeresult = $this->postLikeRepository->removeLikePost($post_id, $authuser->id);

            if($likeresult) {
                return response()->json(['like' => false]);
            } else {
                return response()->json(['error' => 'Error occured when removing like to a post']);
            }
        }
        return response()->json();

    }
}
