<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function GuzzleHttp\Promise\all;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::query()->with(['answers', 'user', 'tags'])->orderByDesc('id')->get();
        return Inertia::render('Questions/Index', [
            'questions' => $questions,
        ]);

    }

    public function create()
    {
        return Inertia::render('Questions/Create');
    }

    public function store(Request $request)
    {
        Question::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect(route('questions.index'));
    }

    public function show($id)
    {
        $question = Question::query()->with(['answers', 'user', 'tags'])->find($id);

        return Inertia::render('Questions/Show', [
            'question' => $question,
        ]);

    }

    public function edit($id)
    {
        $question = Question::find($id);
        if ($question->user_id === auth()->id()){
            return Inertia::render('Questions/Edit',[
                'question' => $question,
            ]);
        }

        return redirect(route('questions.show', $id));
    }

    public function update($id, Request $request)
    {
        $question = Question::find($id);
        if ($question->user_id === auth()->id()){
            $question->update([
                'title'=> $request->title,
                'description'=> $request->description,
            ]);
        }
        return Inertia::render('Questions/Edit',[
            'question' => $question,
            ]);
    }

    public function delete($id)
    {

        $question = Question::find($id);
        if ($question->user_id === auth()->id()){
            $question->delete();
        }
        return Inertia::location(route('questions.index'));
    }

}
