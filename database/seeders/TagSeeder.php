<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['PHP','Laravel','Back and davelopment','Front and davelopment'];

        foreach ($categories as $category) {
            Tag::create([
                'name' => $category
            ]);
        }
    }
}
