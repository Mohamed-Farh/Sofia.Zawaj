<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Dashboard\CityRequest;

class CityController extends Controller
{

    use HelperTrait;
    public function index()
    {
        $records = City::orderBy('id', 'desc')->paginate(10);

        return view('backend.cities.index', compact('records'));
    }

    public function create()
    {
        session("statusEdit", 0);
        return view('backend.cities.create');
    }

    public function store(CityRequest $request)
    {
        City::create($request->all());
        return redirect()->route('admin.city.index')->with([
            'message' => 'City Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function edit($id)
    {
        $record = City::find($id);
        session([
            "statusEdit" => 1,
            "idEdit" => $id
        ]);

        return view('backend.cities.edit', compact("record"));
    }


    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('admin.city.index')->with([
            'message' => 'City Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $record = City::find($id);
        $doctors = $record->doctors;
        if ($doctors->count() == 0) {
            $record->delete();
            return redirect()->route('admin.city.index')->with([
                'message' => 'City Deleted Successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.city.index')->with([
                'message' => trans('main_trans.cantDelete'),
                'alert-type' => 'danger'
            ]);
        }
    }

}
