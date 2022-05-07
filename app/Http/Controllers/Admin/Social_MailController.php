<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social_Mail;

use Illuminate\Http\Request;

class Social_MailController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $social_mails = Social_Mail::all();

       return view('pages.admin.socials.index', compact('social_mails'));
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
            //    'name' => 'required|min:3|max:50|unique:social_mails',
               'type' => 'required',
               'link' => 'required|url|unique:social_mails',
           ];
           $this->validate($request, $rules);

           $social = new Social_Mail();
        //    $social->name    = $request->name;
           $social->type    = $request->type;
           $social->link    = $request->link;
           $social->save();
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
           $rules = [
            //    'name' => 'min:3|max:50',
               'type' => 'required',
               'link' => 'required|url',
           ];
           $this->validate($request, $rules);

           $social = Social_Mail::findOrFail($request->id);
           $social->update([
            //    $social->name = $request->name,
               $social->type = $request->type,
               $social->link = $request->link,
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
       $socials = Social_Mail::findOrFail($request->id)->delete();
       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }


   public function socials_visible(Request $request)
   {
       try {
           $social = Social_Mail::findOrFail($request->id);

           if($social->status == '0'){
               $social->update([
                   $social->status = '1',
               ]);
           }elseif($social->status == '1'){
               $social->update([
                   $social->status = '0',
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

