<?php

namespace App\Http\Controllers\Admin\App;

use App\Http\Controllers\Controller;
use App\Models\App\WebsiteBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class WebsiteBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = WebsiteBanner::orderBy('id', 'asc')->get();

        return view('pages.admin._app.website_banner.index', compact('records'));
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

            if ($file != '') {
                $file = $request->file('image');
                $file_name = time() . '.' . $file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(500, 265);
                $resize_image->save('image/logo/' . $file_name);

                $save = 'image/logo/' . $file_name;
            }

            $advs = new WebsiteBanner;
            $advs->image       = $save;
            $advs->name        = $request->name;
            $advs->text        = str_replace("&nbsp;", " ", (strip_tags($request->text)));
            $advs->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('website_banner.index');
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

            $record = WebsiteBanner::where('id', $request->id)->first();

            //To Store One Photo For Home Page
            if ($request->file('image')) {
                $file = $request->file('image');
                $file_name = time() . '.' . $file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(500, 265);
                $resize_image->save('image/logo/' . $file_name);

                if ($resize_image->save('image/logo/' . $file_name)) {

                    if ($record->image != '') {
                        $old_file = $record->image; //get old photo
                        unlink($old_file);  //delete old photo from folder
                        $record->image = 'image/logo/' . $file_name;
                        $record->save();
                    }
                }
            }

            $record->update([
                $record->name = $request->name,
                $record->text = str_replace("&nbsp;", " ", (strip_tags($request->text))),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('website_banner.index');
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
        //
    }
}
