<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Privacy_Rule;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.R
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacy_rules = Privacy_Rule::where('type', 'privacy')->get();

        return view('pages.admin.privacy.index', compact('privacy_rules'));
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
            $rules = [
                'name' => 'required|min:3',
            ];
            $this->validate($request, $rules);

            $privacy_rule = new Privacy_Rule();
            $privacy_rule->name    = $request->name;
            $privacy_rule->type    = $request->type;
            $privacy_rule->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('privacy.index');
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
            $rules = [
                'name' => 'required|min:3',
            ];
            $this->validate($request, $rules);

            $privacy_rule = Privacy_Rule::findOrFail($request->id);
            $privacy_rule->update([
                $privacy_rule->name    = $request->name,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('privacy.index');
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
        $privacy_rule = Privacy_Rule::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('privacy.index');
    }


    public function privacy_visible(Request $request)
    {
        try {
            $category = Privacy_Rule::findOrFail($request->id);

            if($category->status == '0'){
                $category->update([
                    $category->status = '1',
                ]);
            }elseif($category->status == '1'){
                $category->update([
                    $category->status = '0',
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
