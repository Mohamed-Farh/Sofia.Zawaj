<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Member_Inbox;
use Illuminate\Http\Request;

class Member_InboxController extends Controller
{
    public function show_member_inboxs($id)
    {
        $member = Member::where('id', $id)->first();

        $member_inboxs = Member_Inbox::where('member_id', $id)->orderBy('id', 'desc')->get();

        return view('pages.admin.member_inboxs.index', compact('id','member_inboxs', 'member'));
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
        try{
             $member_inbox = new Member_Inbox();
             $member_inbox->member_id          = $request->member_id;
             $member_inbox->subject            = $request->subject;
             $member_inbox->message            = $request->message;
             $member_inbox->sender_member_id   = $request->sender_member_id;
             $member_inbox->save();

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

             $member_inbox = Member_Inbox::where('id', $request->id)->first();

             $member_inbox->update([
                $member_inbox->subject            = $request->subject,
                $member_inbox->message            = $request->message,
                $member_inbox->sender_member_id   = $request->sender_member_id,
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
        $member_inbox = Member_Inbox::findOrFail($request->id);
        $member_inbox->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }



    public function member_inbox_visible(Request $request)
    {
        try {
            $member_inbox = Member_Inbox::findOrFail($request->id);

            if($member_inbox->show == '0'){
                $member_inbox->update([
                    $member_inbox->show = '1',
                ]);
            }elseif($member_inbox->show == '1'){
                $member_inbox->update([
                    $member_inbox->show = '0',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function member_inbox_read(Request $request)
    {
        try {
            $member_inbox = Member_Inbox::findOrFail($request->id);

            if($member_inbox->read == '0'){
                $member_inbox->update([
                    $member_inbox->read = '1',
                ]);
            }elseif($member_inbox->read == '1'){
                $member_inbox->update([
                    $member_inbox->read = '0',
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
