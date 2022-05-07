<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\Adv;
use Illuminate\Http\Request;

class AdvController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $advs = Adv::orderBy('id', 'desc')->get();

       return view('pages.admin.advs.index', compact('advs'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {

       try {
            //To Store One Photo For Home Page
            $file = $request->hasFile('image');

            if ($file != '' ) {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(500, 265);
                $resize_image->save('image/advertising/'.$file_name);

                $save = $file_name;
            }else{
                    $save = 'default_adv.png';
            }

           $advs = new Adv;
           $advs->image         = $save;
           $advs->name          = $request->name;
           $advs->country       = $request->country;
           $advs->word          = str_replace("&nbsp;"," ", ( strip_tags($request->word ) ));
        //    $advs->link          = $link;
           $advs->save();

           toastr()->success(trans('messages.success'));
           return redirect()->route('advs.index');
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

           $advs = Adv::where('id', $request->id)->first();

           //To Store One Photo For Home Page
           if($request->file('image'))
            {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(500, 265);
                $resize_image->save('image/advertising/'.$file_name);

                if ( $resize_image->save('image/advertising/'.$file_name) ){

                    if( $advs->image == 'default_adv.png'){

                        $advs->image = $file_name;
                        $advs->save();

                    }else{

                        $old_file = $advs->image; //get old photo
                        unlink('image/advertising/'.$old_file);  //delete old photo from folder
                        $advs->image = $file_name;
                        $advs->save();
                    }

                }
            }

            $advs->update([
                $advs->name          = $request->name,
                // $advs->link          = $request->link,
                $advs->country       = $request->country,
                $advs->word          = str_replace("&nbsp;"," ", ( strip_tags($request->word ) )),

            ]);
           toastr()->success(trans('messages.Update'));
           return redirect()->route('advs.index');
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
       $advs = Adv::findOrFail($request->id);
        if($advs->image)
        {
           if (File::exists('image/advertising/' .$advs->image) ) {
               unlink('image/advertising/'.$advs->image);
           }
        }
        $advs->delete();

        toastr()->error(trans('messages.Delete'));
         return redirect()->back();
    }


   public function advs_visible(Request $request)
   {
       try {
           $advs = Adv::findOrFail($request->id);

           if($advs->status == '0'){
               $advs->update([
                   $advs->status = '1',
               ]);
           }elseif($advs->status == '1'){
               $advs->update([
                   $advs->status = '0',
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
