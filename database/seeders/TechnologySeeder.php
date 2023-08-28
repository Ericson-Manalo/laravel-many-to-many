<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $technologies = [
            "PHP",
            "Hack",
            "Vue",
            "CSS",
            "HTML",
            "Javascript",
        ];

        foreach ($technologies as $technology){
            $newTechnology = new Technology();
            $newTechnology ->name = $technology;
            $newTechnology->save();
        }
    }
}
