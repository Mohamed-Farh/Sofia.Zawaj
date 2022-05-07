<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Common_Question;
use Illuminate\Http\Request;

class Common_QuestionController extends Controller
{
    /**
     * Display a listing of the resource.R
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $common_questions = Common_Question::all();

        return view('pages.admin.common_questions.index', compact('common_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {
            $question = new Common_Question();
            $question->type           = $request->type;
            $question->question       = str_replace("&nbsp;"," ", ( strip_tags($request->question ) ));
            $question->answer         = str_replace("&nbsp;"," ", ( strip_tags($request->answer ) ));
            $question->save();

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $question = Common_Question::where('id', $request->id)->first();
            $question->update([
                $question->type           = $request->type,
                $question->question       = str_replace("&nbsp;"," ", ( strip_tags($request->question ) )),
                $question->answer         = str_replace("&nbsp;"," ", ( strip_tags($request->answer ) )),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deliver = Common_Question::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('questions.index');

    }


    public function common_question_visible(Request $request)
    {
        try {
            $common_question = Common_Question::findOrFail($request->id);

            if($common_question->status == '0'){
                $common_question->update([
                    $common_question->status = '1',
                ]);
            }elseif($common_question->status == '1'){
                $common_question->update([
                    $common_question->status = '0',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
