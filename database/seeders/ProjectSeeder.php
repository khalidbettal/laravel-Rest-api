<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // WithoutModelEvents::class,
        Project::factory()->create(
            [
                'title' => 'My first project',
                'creator_id' => 1,
            ]
        );
        
    }
}
