<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(16);

        return view('pages.admin.sliders.index', compact('sliders'));
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
            $request->validate([
                'files' => 'required',
            ]);

            $input=$request->all();
            if($files=$request->file('files')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $fileextention =$file->getClientOriginalExtension();  //get Extention of Image
                    $file_to_store=time().'_'.explode('.',$name)[0].'_.'.$fileextention;

                    $resize_image = Image::make($file)->resize(1110, 555);
                    $resize_image->save('image/gallery/slider/'.$file_to_store);
                    // $file->move('image/gallery/slider',$file_to_store);
                    Slider::create([
                        'name' => $file_to_store,
                        'path' => 'image/gallery/slider/'.$file_to_store,
                        'type' => $request->type,
                    ]);
                }
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('sliders.index');
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
            $slider = Slider::findOrFail($request->id);

            if($slider->status == '0'){
                $slider->update([
                    $slider->status = '1',
                ]);
            }elseif($slider->status == '1'){
                $slider->update([
                    $slider->status = '0',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('sliders.index');
        }
        catch (\Exception $e){
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
        try {
            $slider = Slider::findOrFail($request->id);

            if($slider)
            {
                if (File::exists('image/gallery/slider/' .$slider->name) ) {
                    unlink('image/gallery/slider/'.$slider->name);
                }
                $slider->delete();

                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function first_slider(Request $request)
    {
        try {
            $slider = Slider::findOrFail($request->id);

            if($slider->type == '0'){
                $slider->update([
                    $slider->type = '1',
                ]);
            }elseif($slider->type == '1'){
                $slider->update([
                    $slider->type = '0',
                ]);
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('sliders.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
