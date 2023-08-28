<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $typeList = [
            "Public",
            "Private",
            "Sources",
            "Forks",
            "Archived",
            "Can be sponsored",
            "Mirrors",
            "Templates",
        ];

        $languageList = [
            "PHP",
            "Hack",
            "Vue",
            "CSS",
            "HTML",
            "Javascript",
        ];

        $type = Type::all();
        
        for ($i=0; $i < 200; $i++) {
            $newProject = new Project();
            $newProject->type_id = $faker->randomElement($type)->id;
            $newProject->title = $faker->unique()->sentence(3);
            $newProject->description = $faker->paragraph(7);
            $newProject->category = $faker->randomElement($typeList);
            $newProject->language = $faker->randomElement($languageList);
            $newProject->created_date = $faker->date('Y_m_d');
            $newProject->save();
            $newProject->image = $faker->imageUrl(200, 200, 'post', true, 'posts', true, 'png');
            $newProject->save();
            # code...
        }
    }
}
