<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string|max:255',
            'image_link' => 'nullable|url',
            'options' => 'required|array|size:4',
            'options.*' => 'required|string|max:255',
            'correct' => 'required|string|max:255',
            'position' => 'required|integer|min:1',
        ]);

        $question = Question::create([
            'quiz_id' => $validatedData['quiz_id'],
            'question' => $validatedData['question'],
            'image_link' => $validatedData['image_link'],
            'options' => json_encode($validatedData['options']),
            'correct' => $validatedData['correct'],
            'position' => $validatedData['position'],
        ]);

        return redirect()->route('quizzes.index')->with('success', 'question created successfully.');
    }

    public function create()
    {
        $quizzes = Quiz::where('author_id', Auth::id())->get();

        return view('question.create', compact('quizzes'));
    }

    public function index()
    {
        $questions = Question::with('quiz')->get();

        return view('question.index', compact('questions'));
    }
}
