<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => env('ADMIN_NAME'),
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORDHASH'),
        ]);

        \App\Models\User::factory()->create([
            'name' => env('TEST_USER_NAME'),
            'email' => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORDHASH'),
        ]);

        \App\Models\Quiz::factory()->create([
            'name' => 'Quiz 1',
            'main_image_link' => 'https://media.istockphoto.com/id/1186386668/vector/quiz-in-comic-pop-art-style-quiz-brainy-game-word-vector-illustration-design.jpg?s=612x612&w=0&k=20&c=mBQMqQ6kZuC9ZyuV5_uCm80QspqSJ7vRm0MfwL3KLZY=',
            'description' => "Quiz 1 Description",
            'author_id' => 1,
            'published' => 0
        ]);

        \App\Models\Question::factory()->create([
            'quiz_id' => 1,
            'question' => 'Question 1',
            'image_link' => 'https://img.freepik.com/premium-vector/question-mark-with-drawn-white-strokes-dark-background-vector-illustration-handwritten-question-mark-answer-search-concept_175838-3327.jpg',
            'options' => json_encode(['Answer 1', 'Answer 2', 'Answer 3', 'Answer 4']),
            'correct' => 'Answer 2',
            'position' => 1,
        ]);

        \App\Models\Question::factory()->create([
            'quiz_id' => 1,
            'question' => 'Question 2',
            'image_link' => 'https://img.freepik.com/premium-vector/question-mark-with-drawn-white-strokes-dark-background-vector-illustration-handwritten-question-mark-answer-search-concept_175838-3327.jpg',
            'options' => json_encode(['Answer 1', 'Answer 2', 'Answer 3', 'Answer 4']),
            'correct' => 'Answer 3',
            'position' => 2,
        ]);
    }
}
