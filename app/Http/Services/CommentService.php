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

        $professor->again = 0;
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
        $totalDiff = 0;
        $totalComments = 0;

        if(count($professor->comments) == 0) {
            $totalComments = 1;
        } else {
            $totalComments = count($professor->difficulty) + 1;
            foreach ($professor->difficulty as $diff) {
                $totalDiff += intval($diff->difficulty);
            }
            $totalDiff += $diff;
        }

        $finalDiff = floatval($totalDiff / $totalComments);
        $professor->difficulty = $finalDiff;
        $professor->save();
    }

    private function countAgain(bool $again, Professor $professor)
    {
        $totalAgain = 0;
        $totalComments = 0;

        if(count($professor->comments) == 0) {
            $totalComments = 1;
        } else {
            $totalComments = count($professor->again) + 1;
            foreach ($professor->again as $diff) {
                $totalAgain += intval($diff->again);
            }
            $totalAgain += $again;
        }

        $finalAgain = floatval($totalAgain / $totalComments);
        $professor->again = $finalAgain;
        $professor->save();
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
