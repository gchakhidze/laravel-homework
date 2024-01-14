<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class QuizController extends Controller
{
    public function index(){
        $query = Quiz::withCount('questions');

        if (auth()->id() != 1) {
            $query->where('published', 1);
        }

        $quizzes = $query->orderBy('created_at', 'DESC')->get();

        return view('quiz.index', compact('quizzes'));
    }

    public function show(string $id){
        $quiz = Quiz::with(['questions' => function ($query) {
            $query->orderBy('position')
                ->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('quiz.show', compact('quiz'));
    }

    public function edit(string $id){
        $quiz = Quiz::findOrFail($id);
        return view('quiz.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'main_image_link' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $quiz->fill($validatedData)->save();
        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'main_image_link' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $quiz = Quiz::create([
            'name' => $validatedData['name'],
            'main_image_link' => $validatedData['main_image_link'],
            'description' => $validatedData['description'],
            'author_id' => auth()->id(), 
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function create()
    {
        return view('quiz.create');
    }

    public function checkAnswer(Request $request)
    {
        $validated = $request->validate([
            'questionId' => 'required|exists:questions,id',
            'selectedAnswer' => 'required|string',
        ]);

        $question = Question::find($validated['questionId']);
        $isCorrect = $question->correct === $validated['selectedAnswer'];

        return response()->json(['correct' => $isCorrect]);
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        
        if (auth()->id() !== $quiz->author_id) {
            return redirect()->route('quizzes.index')->with('error', 'Unauthorized action.');
        }

        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function togglePublish($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update(['published' => !$quiz->published]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }
}
