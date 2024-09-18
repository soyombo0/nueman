<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Professor;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $professor = Professor::query()->find($data['professor']['id']);
        $totalComments = 0;
        $totalRating = 0;


        if(count($professor->comments) == 0) {
            $totalComments = 1;
        } else {
            $totalComments = count($professor->comments) + 1;
            foreach ($professor->comments as $comment) {
                $totalRating += intval($comment->rating);
            }
            $totalRating += $data['rating'];
        }
        $finalRating = floatval($totalRating / $totalComments);

        $professor->grade = round($finalRating, 2);
        $professor->save();

        $comment = Comment::query()->create([
            'text' => $data['text'],
            'professor_id' => $professor->id,
            'rating' => $data['rating']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
