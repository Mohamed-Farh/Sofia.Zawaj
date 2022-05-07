<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company_Location;

use Illuminate\Http\Request;

class Company_LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.company_location.index');

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

            $location = new Company_Location();
            $location->country             = $request->country;
            $location->city                = $request->city;
            $location->address             = $request->address;
            $location->phone               = $request->phone;
            $location->whats               = $request->whats;
            $location->map_url             = $request->map_url;
            $location->map_frame           = $request->map_frame;
            $location->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('company_location.index');
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
            // $aboutus = Aboutus::where('id', $aboutus->id)->first();
            // Aboutus::where('id',$id)->first()->update($request->all());


            $location = Company_Location::findOrFail($request->id);
            $location->update([
                $location->country             = $request->country,
                $location->city                = $request->city,
                $location->address             = $request->address,
                $location->phone               = $request->phone,
                $location->whats               = $request->whats,
                $location->whats               = $request->whats,
                $location->map_frame           = $request->map_frame,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('company_location.index');
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
        $location = Company_Location::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('company_location.index');
    }
}
