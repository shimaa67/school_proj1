<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Stage;
use App\Models\Grade;
use App\Models\Section;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Stage::create([
         'name'=>'المرحلة الابتدائية',
          'tag'=>'p'
        ]);
         Stage::create([
         'name'=>'المرحلة الاعدادية',
          'tag'=>'m'
        ]);
         Stage::create([
         'name'=>'المرحلة الثانوية',
          'tag'=>'h'
        ]);
        //  $stagep=Stage::getIdByTag('h');
        // Section::create([
        //     'name'=>'12',
        //     'stage_id'=>$stagep,
        //     'tag'=>'12',
        // ]);
    }
}
