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

        return redirect()->route('questions.index')->with('success', 'question created successfully.');
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

    public function destroy($id)
    {
        $question = question::findOrFail($id);
        
        if (auth()->id() !== $question->quiz->author_id) {
            return redirect()->route('questions.index')->with('error', 'Unauthorized action.');
        }

        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }

    public function edit(string $id){
        $question = Question::findOrFail($id);
        $quizzes = Quiz::all();

        return view('question.edit', compact('question', 'quizzes'));
    }

    public function update(Request $request, $id)
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

        $question = Question::findOrFail($id);

        $question->update([
            'quiz_id' => $validatedData['quiz_id'],
            'question' => $validatedData['question'],
            'image_link' => $validatedData['image_link'],
            'options' => json_encode($validatedData['options']),
            'correct' => $validatedData['correct'],
            'position' => $validatedData['position'],
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }
}
