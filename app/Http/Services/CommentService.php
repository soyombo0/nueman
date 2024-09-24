<?php

namespace App\Http\Services;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Professor;
use Inertia\Inertia;
use function Laravel\Prompts\alert;
use function Laravel\Prompts\error;

class CommentService
{
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $professor = Professor::query()->find($data['professor']['id']);
        $totalComments = 0;
        $totalRating = 0;

        $banWordsCheck = $this->checkBanWords($data['text']);

        if($banWordsCheck === false) {
            return false;
        }

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

        return $comment = Comment::query()->create([
            'text' => $data['text'],
            'professor_id' => $professor->id,
            'rating' => $data['rating']
        ]);
    }

    private function checkBanWords(string $text)
    {
        $bannedWords = [
            'pisda',
            'sda',
            'baas',
            'gichii',
            'gchii',
            'pizda',
            'psda',
            'pzda',
            'yanhan'
        ];

        foreach ($bannedWords as $bannedWord) {
            if (str_contains($text, $bannedWord)) {
                return false;
            };
        }

        return true;
    }
}
