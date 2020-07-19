<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepositoryInterface;

use Auth;

class CommentController extends Controller
{

    protected $commentRepository;

    /**
     * UserController constructor.
     *
     * @param commentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(Request $request)
    {

    	$request->validate([
            'post_id'=>'required|integer',
            'comment_id'=>'required|integer',
            'body'=>'required'
        ]);

        $post_id = $request->post_id;
        $parent_id = $request->comment_id;
        $authuser = Auth::user();
        $body = $request->body;

        $comment_result = $this->commentRepository->store($post_id, $parent_id, $authuser->id, $body);

        if($comment_result)
        {
            return response()->json(['comment' => true]);
        } else {
            return response()->json(['comment' => true], 400);
        }
        
        return response()->json(['error' => 'Unideitifed Error, Please contact our personnel immediately'], 400);
    }

    public function pullReplies(Request $request) {
        $post_id = $request->post_id;
        $parent_id = $request->parent_id;

        $result = $this->commentRepository->findComments($post_id, $parent_id);

        return response()->json($result);
    }
}
