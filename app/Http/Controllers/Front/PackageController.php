<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Package_Feature;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function package_index(Request $request)
    {
        try{
            $packages = Package::whereStatus('0')->get();

            $packages_counts = count($packages);
            return view('includes.packages.package_index', compact('packages', 'packages_counts'));
        }
       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }


    public function front_package_features($id)
    {
        try{
            $package = Package::where('id', $id)->first();

            $features = Package_Feature::where('package_id', $id)->orderBy('id', 'desc')->get();

            return view('includes.packages.package_features', compact('id','package', 'features'));
        }
       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }
}
