<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditQuestion;

class AuditQuestionController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LIST QUESTIONS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {

        $query = AuditQuestion::query();

        if($request->question){
            $query->where('question','like','%'.$request->question.'%');
        }

        if($request->status !== null && $request->status !== ''){
            $query->where('status',$request->status);
        }

        $questions = $query
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('backend.audit_questions.index', compact('questions'));

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('backend.audit_questions.create');
    }



    /*
    |--------------------------------------------------------------------------
    | STORE QUESTION
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'question' => 'required',

            'options' => 'required',

            'risk_answer' => 'nullable',

            'sort_order' => 'nullable|integer'

        ]);

        AuditQuestion::create([

            'question' => $request->question,

            'type' => $request->type ?? 'radio',

            'options' => $request->options,

            'risk_answer' => $request->risk_answer,

            'risk_title' => $request->risk_title,

            'risk_description' => $request->risk_description,

            'sort_order' => $request->sort_order ?? 0,

            'status' => $request->status ?? 1

        ]);

        return redirect()
            ->route('admin.audit.questions.index')
            ->with('success','Question created successfully');

    }



    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {

        $question = AuditQuestion::findOrFail($id);

        return view('backend.audit_questions.edit', compact('question'));

    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE QUESTION
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {

        $request->validate([

            'question' => 'required',

            'options' => 'required',

            'sort_order' => 'nullable|integer'

        ]);

        $question = AuditQuestion::findOrFail($id);

        $question->update([

            'question' => $request->question,

            'type' => $request->type ?? 'radio',

            'options' => $request->options,

            'risk_answer' => $request->risk_answer,

            'risk_title' => $request->risk_title,

            'risk_description' => $request->risk_description,

            'sort_order' => $request->sort_order ?? 0,

            'status' => $request->status ?? 1

        ]);

        return redirect()
            ->route('admin.audit.questions.index')
            ->with('success','Question updated successfully');

    }



    /*
    |--------------------------------------------------------------------------
    | DELETE QUESTION
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {

        $question = AuditQuestion::findOrFail($id);

        $question->delete();

        return redirect()
            ->route('admin.audit.questions.index')
            ->with('success','Question deleted successfully');

    }

}