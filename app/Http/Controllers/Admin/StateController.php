<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class StateController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $states = State::all();
       $countries = Country::where('status', 1)->get(['id', 'name']);

       return view('pages.admin.states.index', compact('states', 'countries'));
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
           $states = new State();
           $states->name    = $request->name;
           $states->country_id  = $request->country_id;
           $states->status  = $request->status;
           $states->save();
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

           $states = State::findOrFail($request->id);
           $states->update([
                $states->name    = $request->name,
                $states->country_id  = $request->country_id,
                $states->status    = $request->status,
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
    $states = State::findOrFail($request->id)->delete();
       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }



}
