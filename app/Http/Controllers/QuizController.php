<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index(){
        return view('quiz.index', ['quizzes' => Quiz::all()]);
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
