<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::query()->create([
            'name' => 'ANUIS'
        ]);
        School::query()->create([
            'name' => 'HZSTAN'
        ]);
        School::query()->create([
            'name' => 'MUIS'
        ]);
    }
}
