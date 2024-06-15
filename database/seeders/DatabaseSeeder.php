<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Prerequisite;
use App\Models\Section;
use App\Models\Topic;
use App\Models\Trainer;
use App\Models\Tutorial;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ajout de deux étudiants
        // Utiliser un service pour générer l'URL de l'avatar avec les initiales
        $avatarUrl1 = "https://ui-avatars.com/api/?name=sh&background=random&size=128";
        User::create([
            'name' => 'Sarah Hunt',
            'email' => 'etudiant@example.com',
            'password' => Hash::make('123'),
            'avatar' => $avatarUrl1,
            //'is_premium' => false, par défaut
            //'role' => 'student', par défaut
        ]);

        $avatarUrl2 = "https://ui-avatars.com/api/?name=mk&background=random&size=128";
        User::create([
            'name' => 'Mark Kponfler',
            'email' => 'premium@example.com',
            'password' => Hash::make('123'),
            'avatar' => $avatarUrl2,
            'is_premium' => true,
        ]);

        // Ajout de l'administrateur
        $avatarUrl2 = "https://ui-avatars.com/api/?name=jh&background=random&size=128";
        User::create([
            'name' => 'John Doe',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'avatar' => $avatarUrl2,
            'role' => 'admin',
        ]);

        // Créer 5 topics
        Topic::factory(5)->create();

        // Créer 10 formateurs
        $trainers = Trainer::factory(10)->create();

        // Créer 20 cours
        Course::factory(20)->create()->each(function ($course) use ($trainers) {
            // Attribuer aléatoirement 1 à 3 formateurs à chaque cours
            $course->trainers()->attach(
                $trainers->random(rand(1, 3))->pluck('id')->toArray()
            );

            // Générer 1 à 4 sections pour chaque cours
            $sections = Section::factory(rand(1, 4))->create(['course_id' => $course->id]);

            // Pour chaque section, générer 1 à 5 tutoriels
            $sections->each(function ($section) {
                Tutorial::factory(rand(1, 5))->create(['section_id' => $section->id]);
            });

            // Générer 0 à 4 prérequis pour chaque cours
            Prerequisite::factory(rand(0, 4))->create(['course_id' => $course->id]);
        });



        /*
        Topic::factory(5)->create();

        $courses = Course::factory(20)->create();
        
        $trainers = Trainer::factory(10)->create();

        // Attacher les formateurs aux cours
        $courses->each(function ($course) use ($trainers) {
            $course->trainers()->attach(
                $trainers->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Créer des sections avec des tutoriels et les attacher aux cours
        $courses->each(function ($course) {
            
            $sections = Section::factory(rand(1, 4))->create(); // Crée de 1 à 4 sections par cours

            $sections->each(function ($section) {
                $tutorials = Tutorial::factory(rand(1, 5))->create(); // Crée de 1 à 5 tutoriels par section
                $section->tutorials()->saveMany($tutorials);
            });
            $course->sections()->saveMany($sections);
        });*/
    }
}
