<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\App_Feature;
use Illuminate\Http\Request;

class App_FeatureController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $app_features = App_Feature::all();

       return view('pages.admin.app_features.index', compact('app_features'));
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

           $app_feature = new App_Feature();
           $app_feature->feature_text    = $request->feature_text;
           $app_feature->feature_type    = $request->feature_type;
           $app_feature->save();
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

           $app_feature = App_Feature::findOrFail($request->id);
           $app_feature->update([
                $app_feature->feature_text    = $request->feature_text,
                $app_feature->feature_type    = $request->feature_type,
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
       $app_feature = App_Feature::findOrFail($request->id)->delete();
       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }


   public function app_feature_visible(Request $request)
   {
       try {
           $app_feature = App_Feature::findOrFail($request->id);

           if($app_feature->status == '0'){
               $app_feature->update([
                   $app_feature->status = '1',
               ]);
           }elseif($app_feature->status == '1'){
               $app_feature->update([
                   $app_feature->status = '0',
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
