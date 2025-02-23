<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*User::factory(10)->create();
        Category::factory(5)->create();
        Question::factory(40)->create();
        Comment::factory(80)->create();
        Tag::factory(18)->create();*/

        Tag::factory(6)->create();
        Category::factory(5)->has(Question::factory(10)->hasComments(8))->create();
        $tags = Tag::all();
        Question::all()->each(function ($question) use ($tags) {
            $question->tags()->attach(
                $tags->random(rand(1, 6))->pluck('id')->toArray()
            );
        });
        
    }
}
