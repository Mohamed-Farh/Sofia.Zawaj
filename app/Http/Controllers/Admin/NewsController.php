<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();

        // $top_new = News::where('status', '0');

        return view('pages.admin.news.index', compact('news'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.news.create');
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

            //To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();

                $resize_image = Image::make($image)->resize(800, 500);
                $resize_image->save('image/news/'.$name);
                // $destinationPath =('image/news');
                // $image->move($destinationPath, $name);
                $photo=$name;
            }

            $news = new News();
            $news->head            =  strip_tags($request->head);
            $news->body            =  strip_tags($request->body);
            $news->photo           =  $photo;

            $news->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('news.index');
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
        $new = News::findOrFail($id);

        return view('pages.admin.news.edit', compact('new'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        try {
            $news = News::where('id', $news->id)->first();

            // To Store One Photo For Home Page
            if ($request->hasFile('photo')){
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();

                $resize_image = Image::make($image)->resize(800, 500);
                $resize_image->save('image/news/'.$name);
                // $destinationPath =('image/news');

                if ( $resize_image->save('image/news/'.$name )){
                    if($news->photo){
                    $old_photo = $news->photo; //get old photo
                    unlink('image/news/'.$old_photo);  //delete old photo from folder
                    }
                    $news->photo = $name;
                    $news->save();
                }
            }

            $news->update([
                $news->head = strip_tags($request->head),
                $news->body = strip_tags($request->body),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('news.index');
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
        $news = News::findOrFail($request->id);
        if($news->photo)
        {
            if (File::exists('image/news/' .$news->photo) ) {
                unlink('image/news/'.$news->photo);
            }
        }
        $news->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('news.index');
    }
}
