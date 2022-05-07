<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Package_Feature;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function index()
    {
        $packages =Package::orderBy('id', 'desc')->get();

        return view('pages.admin.packages.index', compact('packages'));
    }


    public function create()
    {
        return view('pages.admin.packages.create');
    }


    public function store(Request $request)
    {
        try{

            $package = new Package();
            $package->name                  = $request->name;
            $package->month_no              = $request->month_no;
            $package->price                 = $request->price;
            $package->description           = str_replace("&nbsp;"," ", ( strip_tags($request->description ) ));
            $package->pay_join              = str_replace("&nbsp;"," ", ( strip_tags($request->pay_join ) ));
            $package->after_choose_pay      = str_replace("&nbsp;"," ", ( strip_tags($request->after_choose_pay ) ));
            $package->save();


            toastr()->success('message', 'لقد تم إضافة باقة جديدة بنجاح.');
            return redirect()->route('packages.index');
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
    public function show(Package $package)
    {
        return view('pages.admin.packages.show', compact('package'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('pages.admin.packages.edit', compact('package'));
    }


    public function update(Request $request, $id)
    {
        try {
            $package = Package::whereId($request->id)->first();

            $package->update([
                $package->name                  = $request->name,
                $package->month_no              = $request->month_no,
                $package->price                 = $request->price,
                $package->description           = str_replace("&nbsp;"," ", ( strip_tags($request->description ) )),
                $package->pay_join              = str_replace("&nbsp;"," ", ( strip_tags($request->pay_join ) )),
                $package->after_choose_pay      = str_replace("&nbsp;"," ", ( strip_tags($request->after_choose_pay ) )),
            ]);

            toastr()->success('message', 'لقد تم تعديل بيانات الباقة بنجاح.');
            return redirect()->route('packages.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $features = Package_Feature::findOrFail(1)->where('package_id', $request->id)->pluck('package_id');

            if($features->count() == 0){
                $package = Package::findOrFail($request->id)->delete();
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('packages.index');
            }else{
                toastr()->error(trans('لا يمكن حذف هذة الباقة لوجود مميزات مرتبطة بها , برجي مسح المميزات واعادة المحاولة'));
                return redirect()->route('packages.index');
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function packages_visible(Request $request)
    {
        try {
            $package = Package::findOrFail($request->id);

            if($package->status == '0'){
                $package->update([
                    $package->status = '1',
                ]);
            }elseif($package->status == '1'){
                $package->update([
                    $package->status = '0',
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
