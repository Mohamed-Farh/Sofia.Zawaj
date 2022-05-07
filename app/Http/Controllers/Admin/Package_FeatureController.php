<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Package_Feature;
use Illuminate\Http\Request;

class Package_FeatureController extends Controller
{
    public function show_package_features($id)
    {
        $package = Package::where('id', $id)->first();

        $features = Package_Feature::where('package_id', $id)->orderBy('id', 'desc')->get();

        return view('pages.admin.package_features.index', compact('id', 'package', 'features'));
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
            $features = new Package_Feature();
            $features->package_id      = $request->package_id;
            $features->name     = str_replace("&nbsp;", " ", (strip_tags($request->name)));
            $features->title    = str_replace("&nbsp;", " ", (strip_tags($request->title)));
            $features->save();

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
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

            $features = Package_Feature::where('id', $request->id)->first();

            $features->update([
                // $features->package_id      = $request->package_id,
                $features->name     = str_replace("&nbsp;", " ", (strip_tags($request->name))),
                $features->title    = str_replace("&nbsp;", " ", (strip_tags($request->title))),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        } catch (\Exception $e) {
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
        $features = Package_Feature::findOrFail($request->id);
        $features->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }



    public function package_features_visible(Request $request)
    {
        try {
            $features = Package_Feature::findOrFail($request->id);

            if ($features->show == '0') {
                $features->update([
                    $features->show = '1',
                ]);
            } elseif ($features->show == '1') {
                $features->update([
                    $features->show = '0',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
