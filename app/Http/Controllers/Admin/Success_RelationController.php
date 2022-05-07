<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\Success_Relation;
use Illuminate\Http\Request;

class Success_RelationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $relations = Success_Relation::orderBy('id', 'desc')->get();

       return view('pages.admin.success_relations.index', compact('relations'));
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

                $resize_image = Image::make($file)->resize(135, 135);
                $resize_image->save('image/success_relation/'.$file_name);

                $save = $file_name;
            }else{
                if( $request->gender == 'ذكر'){
                    $save = 'male_avatar.png';
                }else{
                    $save = 'female_avatar.png';
                }

            }

           $relations = new Success_Relation;
           $relations->image         = $save;
           $relations->name          = $request->name;
           $relations->age           = $request->age;
           $relations->gender        = $request->gender;
           $relations->word          = str_replace("&nbsp;"," ", ( strip_tags($request->word ) ));

           $relations->save();




           toastr()->success(trans('messages.success'));
           return redirect()->route('success_relations.index');
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

           $relations = Success_Relation::where('id', $request->id)->first();

           //To Store One Photo For Home Page
           if($request->file('image'))
            {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(135, 135);
                $resize_image->save('image/success_relation/'.$file_name);

                if ( $resize_image->save('image/success_relation/'.$file_name) ){

                    if( $relations->image == 'female_avatar.png'){

                        $relations->image = $file_name;
                        $relations->save();

                    }elseif($relations->image == 'male_avatar.png'){

                        $relations->image = $file_name;
                        $relations->save();

                    }else{

                        $old_file = $relations->image; //get old photo
                        unlink('image/success_relation/'.$old_file);  //delete old photo from folder
                        $relations->image = $file_name;
                        $relations->save();
                    }

                }
            }

            $relations->update([
                $relations->name          = $request->name,
                $relations->age           = $request->age,
                $relations->gender        = $request->gender,
                $relations->word          = str_replace("&nbsp;"," ", ( strip_tags($request->word ) )),

            ]);
           toastr()->success(trans('messages.Update'));
           return redirect()->route('success_relations.index');
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
       $relations = Success_Relation::findOrFail($request->id);
       if($relations->image)
       {
           if (File::exists('image/success_relations/' .$relations->image) ) {
               unlink('image/success_relations/'.$relations->image);
           }
       }
       $relations->delete();

       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }


   public function success_relations_visible(Request $request)
   {
       try {
           $relations = Success_Relation::findOrFail($request->id);

           if($relations->status == '0'){
               $relations->update([
                   $relations->status = '1',
               ]);
           }elseif($relations->status == '1'){
               $relations->update([
                   $relations->status = '0',
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
