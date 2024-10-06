<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Services\CommentService;
use App\Models\Comment;
use App\Models\Professor;
use function Laravel\Prompts\error;

class CommentController extends Controller
{
    public function __construct(
        protected CommentService $service
    )
    {
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->service->store($request);

        if($comment === false) {
            return error('contains inapproprirate language');
        }
    }


    public function like(Request $request)
    {

    }

    public function dislike(Request $request)
    {

    }

    public function destroy(DeleteCommentRequest $request)
    {
        $data = $request->validated();
        $commentId = $data['comment']['id'];
        $comment = Comment::query()->find($commentId);

        $comment->delete();
    }
}
