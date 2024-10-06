<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Models\Professor;
use App\Models\School;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = explode(' ', trim($request->name));

        if($name[0] !== "") {
            foreach($name as $n) {
                $professors = Professor::query()
                    ->where('name', 'ilike', '%' . $n . '%')
                    ->get();
            }
        } else {
            $professors = Professor::all();
        }

        return inertia('Professors', [
            'professors' => $professors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('ProfessorAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessorRequest $request)
    {
        $data = $request->validated();

        $professor = Professor::query()->create([
            'name' => $data['name'],
            'department' => $data['department'],
            'school_id' => 1,
        ]);

        return redirect(route('professor.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Professor $professor)
    {
        $school = School::query()->find($professor->school_id);
        $comments = $professor->comments()->get();

        return inertia('Professor', [
            'professor' => $professor,
            'school' => $school,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessorRequest $request, Professor $professor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professor)
    {
        //
    }
}
