<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests\StoreGrades;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('admin', 0)->orderBy('id', 'desc')->paginate(15);

        return view('pages.admin.users.index', compact('users'));
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
                $filePath =('image/users/');
                $file->move($filePath, $file_name);
                $save = $file_name;
            }else{
                $save = 'avatar.png';
            }

            $user = new User;
            $user->image         = $save;
            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->password      = bcrypt($request->password);
            $user->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('users.index');
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
            $rules = [
                'name' => 'required|string|min:3|max:30',
                'email' => 'required|email',
                'password' => 'nullable|min:6',
            ];
            $this->validate($request, $rules);

            $user = User::where('id', $request->id)->first();

            //To Store One Photo For Home Page
            if($request->file('image'))
            {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $filePath =('image/users/');

                if ( $file->move($filePath, $file_name) ){
                    if($user->image != 'avatar.png'){
                        $old_file = $user->image; //get old photo
                        unlink('image/users/'.$old_file);  //delete old photo from folder
                    }
                    $user->image = $file_name;
                    $user->save();
                }
            }

            $user->update([
                $user->name           =  $request->name,
                $user->email          =  $request->email,
                $user->password       =  bcrypt($request->password),

            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('users.index');
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
        $user = User::findOrFail($request->id);
        if($user->image)
        {
            if (File::exists('image/users/' .$user->image) ) {
                unlink('image/users/'.$user->image);
            }
        }
        $user->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
