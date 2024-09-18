<?php

namespace Database\Seeders;

use App\Models\Professor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professor::query()->create([
            'name' => 'Yale Ganberg',
            'department' => 'Finance',
            'school_id' => 1
        ]);
        Professor::query()->create([
            'name' => 'Diana Smith',
            'department' => 'Law',
            'school_id' => 2
        ]);
        Professor::query()->create([
            'name' => 'Ganzorig Boldbaatar',
            'department' => 'Medicine',
            'school_id' => 3
        ]);
    }
}
