<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index(){
        $quizzes = Quiz::where('image', '!=', null)
            ->where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $quizzesMissing = 8 - $quizzes->count();
        if ($quizzesMissing > 0) {
            $quizzesNew = Quiz::where('status', '=', 1)
                ->where('description', '!=', null)
                ->orderBy('created_at', 'desc')
                ->take($quizzesMissing)
                ->get();

            $quizzes = $quizzes->merge($quizzesNew);
        }

        return view('quiz.index', ['quizzes' => $quizzes]);
    }

    public function show(string $id){
        return view('quiz.show', ['quiz' => Quiz::findOrFail($id)]);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $quiz->fill($request->post())->save();
        return redirect()->route('quizzes.index');
    }

    public function store(Request $request)
    {
        Quiz::create($request->post());
        return redirect()->route('quizzes.index');
    }

    public function create()
    {
        return view('quiz.create');
    }
}
