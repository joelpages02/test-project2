<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            'name' => 'Vehicles',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Immobiliària',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Feina',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Tecnologia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Moda i complements',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Llar i jardi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Esports i oci',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Mascotes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Serveis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::insert([
            'name' => 'Altres',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
