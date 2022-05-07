<?php

namespace App\Http\Controllers\Admin\App;

use App\Http\Controllers\Controller;
use App\Models\App\AppHomepages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AppHomepagesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $records = AppHomepages::orderBy('id', 'asc')->get();

       return view('pages.admin._app.app_homepages.index', compact('records'));
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
                 $resize_image->save('image/app_homepages/'.$file_name);

                 $save = 'image/app_homepages/'.$file_name;
             }

            $advs = new AppHomepages;
            $advs->image         = $save;
            $advs->page_no          = $request->page_no;
            $advs->title       = $request->title;
            $advs->content          = str_replace("&nbsp;"," ", ( strip_tags($request->content ) ));
            $advs->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('app_homepages.index');
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

           $record = AppHomepages::where('id', $request->id)->first();

           //To Store One Photo For Home Page
           if($request->file('image'))
            {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(500, 265);
                $resize_image->save('image/app_homepages/'.$file_name);

                if ( $resize_image->save('image/app_homepages/'.$file_name) ){

                    if( $record->image != ''){

                        $old_file = $record->image; //get old photo
                        unlink($old_file);  //delete old photo from folder
                        $record->image = 'image/app_homepages/'.$file_name;
                        $record->save();
                    }
                }
            }

            $record->update([
                $record->title = $request->title,
                $record->content = str_replace("&nbsp;"," ", ( strip_tags($request->content ) )),

            ]);
           toastr()->success(trans('messages.Update'));
           return redirect()->route('app_homepages.index');
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
       //
    }

}
