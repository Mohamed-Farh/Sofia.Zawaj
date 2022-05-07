<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage_Word;
use Illuminate\Http\Request;

class Homepage_WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.homepage_words.index');
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
            $Word = new Homepage_Word();
            $Word->description             = $request->description;
            $Word->type                    = $request->type;
            $Word->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('homepage_words.index');
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
            $word = Homepage_Word::findOrFail($request->id);
            $word->update([
                $word->description             = $request->description,
                $word->type                    = $request->type,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('homepage_words.index');
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
        $word = Homepage_Word::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('homepage_words.index');
    }

    public function homepage_words_visible(Request $request)
    {
        try {
            $word = Homepage_Word::findOrFail($request->id);

            if($word->vision == '0'){
                $word->update([
                    $word->vision = '1',
                ]);
            }elseif($word->vision == '1'){
                $word->update([
                    $word->vision = '0',
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
