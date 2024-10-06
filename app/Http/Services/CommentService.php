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
        $totalComments = count($professor->comments);
        $totalRating = 0;

        $banWordsCheck = $this->checkBanWords($data['text']);

        if($banWordsCheck === false) {
            return false;
        }

        if($totalComments == 0) {
            $totalComments = 1;
        } else {
            $totalComments = count($professor->comments) + 1;
            foreach ($professor->comments as $comment) {
                $totalRating += intval($comment->rating);
            }
        }
        $totalRating += $data['rating'];

        $finalRating = floatval($totalRating / $totalComments);

        $professor->grade = round($finalRating, 2);
        $professor->save();

        $this->countDiff(intval($data['difficulty']), $professor);
        $this->countAgain(boolval($data['again']), $professor);

        return $comment = Comment::query()->create([
            'text' => $data['text'],
            'professor_id' => $professor->id,
            'rating' => $data['rating'],
            'again' => $data['again'],
            'difficulty' => $data['difficulty']
        ]);
    }

    private function countDiff(int $diff, Professor $professor)
    {
        $comments = $professor->comments;
        $commentsAmount = count($comments);
        $totalDiff = 0;

        if ($commentsAmount == 0) {
            $professor->difficulty = $diff;
            $professor->save();
        } else {
            foreach ($comments as $comment) {
                $totalDiff += $comment->difficulty;
            }
            $totalDiff += $diff;
            $commentsAmount += 1;
            $professor->difficulty = $totalDiff/$commentsAmount;
            $professor->save();
        }
    }

    private function countAgain(bool $again, Professor $professor)
    {
        $comments = $professor->comments;
        $commentsAmount = count($comments);
        $totalAgain = 0;

        if ($commentsAmount == 0) {
            $professor->again = $again;
            $professor->save();
        } else {
            foreach ($comments as $comment) {
                $totalAgain += $comment->difficulty;
            }
            $totalAgain += $again;
            $commentsAmount += 1;
            $professor->again = $totalAgain / $commentsAmount;
            $professor->save();
        }
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
