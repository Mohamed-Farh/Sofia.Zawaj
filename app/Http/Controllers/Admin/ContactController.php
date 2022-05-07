<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('pages.admin.contacts.index', compact('contacts'));
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
            $rules = [
                'email' => 'email',
            ];
            $this->validate($request, $rules);

            $contact = new Contact();
            $contact->name          = $request->name;
            $contact->phone         = $request->phone;
            $contact->email         = $request->email;
            $contact->country       = $request->country;
            $contact->subject       = $request->subject;
            $contact->message       = $request->message;
            $contact->save();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
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
                'email' => 'email',
            ];
            $this->validate($request, $rules);

            $contact = Contact::findOrFail($request->id);

            $contact->update([
                $contact->name          = $request->name,
                $contact->phone         = $request->phone,
                $contact->email         = $request->email,
                $contact->country       = $request->country,
                $contact->subject       = $request->subject,
                $contact->message       = $request->message,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
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
        $contact = Contact::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('contacts.index');
    }


    public function contact_visible(Request $request)
    {
        try {
            $contact = Contact::findOrFail($request->id);

            if($contact->status == '0'){
                $contact->update([
                    $contact->status = '1',
                ]);
            }elseif($contact->status == '1'){
                $contact->update([
                    $contact->status = '0',
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
