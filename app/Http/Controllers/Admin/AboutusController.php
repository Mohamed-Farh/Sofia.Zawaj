<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.aboutus.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.aboutus.create');
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
            $aboutus = new Aboutus();
            $aboutus->aboutus       = str_replace("&nbsp;"," ", ( strip_tags($request->aboutus ) ));
            $aboutus->why_us        = str_replace("&nbsp;"," ", ( strip_tags($request->why_us ) ));
            $aboutus->smart         = str_replace("&nbsp;"," ", ( strip_tags($request->smart ) ));
            $aboutus->safe          = str_replace("&nbsp;"," ", ( strip_tags($request->safe ) ));
            $aboutus->secret        = str_replace("&nbsp;"," ", ( strip_tags($request->secret ) ));
            $aboutus->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('aboutus.index');
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

        $aboutus = Aboutus::findOrFail($id);

        return view('pages.admin.aboutus.edit', compact('aboutus'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $aboutus = Aboutus::where('id',$id)->first();
            $aboutus->update([
                $aboutus->aboutus       = str_replace("&nbsp;"," ", ( strip_tags($request->aboutus ) )),
                $aboutus->why_us        = str_replace("&nbsp;"," ", ( strip_tags($request->why_us ) )),
                $aboutus->smart         = str_replace("&nbsp;"," ", ( strip_tags($request->smart ) )),
                $aboutus->safe          = str_replace("&nbsp;"," ", ( strip_tags($request->safe ) )),
                $aboutus->secret        = str_replace("&nbsp;"," ", ( strip_tags($request->secret ) )),
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('aboutus.index');
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
        $aboutus = Aboutus::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('aboutus.index');
    }
}

