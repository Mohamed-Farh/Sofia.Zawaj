<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatMessageResource;
use App\Http\Resources\ShowChatMemberResource;
use App\Models\Chat\ChatMember;
use App\Models\Chat\ChatMessage;
use App\Models\Member;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    use GeneralTrait;

    //✅
    public function sendChatMessage(Request $request)
    {
        try{
            // return Auth::guard('member_api')->id();
            $rules = [
                "member_id" => "required|exists:members,id",
                "message" => "required",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $id1 = ChatMember::where( 'my_id', Auth::guard('member_api')->id() )->where('member_id', $request->member_id)->first();
            $id2 = ChatMember::where( 'my_id', $request->member_id )->where('member_id', Auth::guard('member_api')->id())->first();

            if($id1 != null ){
                $chat_members = $id1;
            }elseif($id2 != null ){
                $chat_members = $id2;
            }else{
                $chat_members = ChatMember::create([
                    "my_id" => Auth::guard('member_api')->id(),
                    "member_id" => $request->member_id,
                ]);
            }

            if($chat_members){
                
                $message = ChatMessage::create([
                    "my_id" => Auth::guard('member_api')->id(),
                    "chat_id" => $chat_members->id,
                    "message" => $request->message,
                ]);

                if($request->hasFile('file')){
                    $image_name = date('mdYHis') . uniqid() . $request->file('file')->getClientOriginalName();
                    $path =('image/chat/');
                    $request->file('file')->move($path,$image_name);
                    ChatMessage::where('id', $message->id)->update([
                        'file' => $path.$image_name ,
                    ]);
                }
            }

            return $this->returnSuccessMessage('Message Sent Successfully');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    // public function getChatMessage(Request $request)
    // {
    //     try{
    //         // return Auth::guard('member_api')->id();
    //         $rules = [
    //             "member_id" => "required|exists:members,id",
    //         ];
    //         $validator = Validator::make($request->all(), $rules);
    //         if ($validator->fails()) {
    //             $code = $this->returnCodeAccordingToInput($validator);
    //             return $this->returnValidationError($code, $validator);
    //         }

    //         $id1 = ChatMember::where( 'my_id', Auth::guard('member_api')->id() )->where('member_id', $request->member_id)->first();
    //         $id2 = ChatMember::where( 'my_id', $request->member_id )->where('member_id', Auth::guard('member_api')->id())->first();

    //         if( empty($id1) && empty($id2) ){
    //             return $this -> returnError('400','Please Check Input Data');

    //         }else{
    //             $id1 != null ? $id=$id1 : $id=$id2;
    //             $messages = ChatMessage::where('chat_id', $id->id)
    //                                     ->where('my_delete_status', false)
    //                                     ->paginate(15);

    //             foreach($messages as $message ){
    //                 if($message->my_id != Auth::guard('member_api')->id() ){
    //                     $message->update([ 'seen' => 1 ]);
    //                 }
    //             }


    //             $sender = Member::where('id', $request->member_id)->first();
    //             $sender_data = [
    //                 "member_id" => $sender->id,
    //                 "name" => $sender->name,
    //                 "image" => $sender->image,
    //                 "active" => 0,
    //             ];

    //             $data = [
    //                 "member" => $sender_data,
    //                 'messages' => ChatMessageResource::collection($messages)
    //             ];

    //             return $this -> returnData('data' , $data, 'Member Message');
    //         }

    //     }catch (\Exception $e){
    //         $this -> returnError('400','Some Thing Went Wrongs');
    //     }
    // }
    
    
    public function getChatMessage(Request $request)
    {
        try{
            // return Auth::guard('member_api')->id();
            $rules = [
                "member_id" => "required|exists:members,id",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $id1 = ChatMember::where( 'my_id', Auth::guard('member_api')->id() )->where('member_id', $request->member_id)->first();
            $id2 = ChatMember::where( 'my_id', $request->member_id )->where('member_id', Auth::guard('member_api')->id())->first();

            if( empty($id1) && empty($id2) ){
                return $this -> returnError('400','Please Check Input Data');

            }else{
                $id1 != null ? $id=$id1 : $id=$id2;
                $messages = ChatMessage::where('chat_id', $id->id)
                                        ->where('my_chat_delete', false)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(15);

                foreach($messages as $message ){
                    if($message->my_id != Auth::guard('member_api')->id() ){
                        $message->update([ 'seen' => 1 ]);
                    }
                }


                $sender = Member::where('id', $request->member_id)->first();
                $sender_data = [
                    "member_id" => $sender->id,
                    "name" => $sender->name,
                    "image" => $sender->image,
                    "active" => 0,
                ];

                $data = [
                    "member" => $sender_data,
                    'messages' => ChatMessageResource::collection($messages)
                ];

                return $this -> returnData('data' , $data, 'Member Message');
            }

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }


    //-------------------------------------------------------------------------
    //✅
    // public function deleteChatMessage(Request $request)
    // {
    //     try{
    //         // return Auth::guard('member_api')->id();
    //         $rules = [
    //             "message_id" => "required|exists:chat_messages,id",
    //         ];
    //         $validator = Validator::make($request->all(), $rules);
    //         if ($validator->fails()) {
    //             $code = $this->returnCodeAccordingToInput($validator);
    //             return $this->returnValidationError($code, $validator);
    //         }

    //         foreach($request->message_id as $id ){
    //             $message = ChatMessage::where('id', $id)->first();
    //             if($message->my_id == Auth::guard('member_api')->id()){
    //                 $message->update([ 'my_delete_status' => 1 ]);
    //             }else{
    //                 $message->update([ 'mmember_delete_status' => 1 ]);
    //             }
    //         }
    //         return $this->returnSuccessMessage('Message Deleted Successfully');
    //     }catch (\Exception $e){
    //         $this -> returnError('400','Some Thing Went Wrongs');
    //     }
    // }
    
    
    public function deleteChatMessage(Request $request)
    {
        try{
            // return Auth::guard('member_api')->id();
            $rules = [
                "message_id" => "required|exists:chat_messages,id",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            foreach($request->message_id as $id ){
                $message = ChatMessage::where('id', $id)->first();
                if($message->my_id == Auth::guard('member_api')->id()){
                    $message->update([ 'my_chat_delete' => true ]);
                }else{
                    $message->update([ 'mmember_chat_delete' => true ]);
                }
            }
            return $this->returnSuccessMessage('Message Deleted Successfully');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    // public function deleteAllChat(Request $request)
    // {
    //     try{
    //         // return Auth::guard('member_api')->id();
    //         $rules = [
    //             "chat_id" => "required|exists:chat_messages,chat_id",
    //         ];
    //         $validator = Validator::make($request->all(), $rules);
    //         if ($validator->fails()) {
    //             $code = $this->returnCodeAccordingToInput($validator);
    //             return $this->returnValidationError($code, $validator);
    //         }

    //         foreach($request->chat_id as $id ){
    //             $messages = ChatMessage::where('chat_id', $id)->get();
    //             foreach($messages as $message ){
    //                 $message->update([ 'my_delete_status' => 1 ]);
    //             }

    //             $member = ChatMember::where('id', $id)->first();
    //             if($member->my_id != Auth::guard('member_api')->id() ){
    //                 $member->update([ 'member_delete_status' => 1 ]);
    //             }else{
    //                 $member->update([ 'my_delete_status' => 1 ]);
    //             }
    //         }
    //         return $this->returnSuccessMessage('All Chat Deleted Successfully');
    //     }catch (\Exception $e){
    //         $this -> returnError('400','Some Thing Went Wrongs');
    //     }
    // }
    
    public function deleteAllChat(Request $request)
    {
        try{
            // return Auth::guard('member_api')->id();
            $rules = [
                "chat_id" => "required|exists:chat_messages,chat_id",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            foreach($request->chat_id as $id ){
                $messages = ChatMessage::where('chat_id', $id)->get();
                foreach($messages as $message ){
                    $message->update([ 'my_delete_status' => 1 ]);
                    $message->update([ 'my_chat_delete' => 1 ]);
                    
                }

                $member = ChatMember::where('id', $id)->first();
                // if($member->my_id != Auth::guard('member_api')->id() ){
                //     $member->update([ 'my_chat_delete' => 1 ]);
                // }else{
                //     $member->update([ 'member_chat_delete' => 1 ]);
                // }
            }
            return $this->returnSuccessMessage('All Chat Deleted Successfully');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }


    //-------------------------------------------------------------------------
    //✅
    public function getChatMembers(Request $request)
    {
        try{
            $members = ChatMember::where(function ($query) {
                                    $query->where([['my_id', '=', Auth::guard('member_api')->id()],['my_delete_status', 0]] )
                                        ->orWhere([['member_id', '=', Auth::guard('member_api')->id()],['my_delete_status', 0]] );
                                })->orderBy('created_at', 'desc')->get();
                                
            // foreach($members as $member){
            //     $count = ChatMessage::where('chat_id', $member->id)->where('my_chat_delete', false)->count();
            //     if($count > 0){
            //         return $this -> returnData('data' , new ShowChatMemberResource($member), 'My Chat Members');
            //     }
            //     else{
            //         return $this->returnSuccessMessage('لا يوجد أي محادثات');
            //     }
            // }

            return $this -> returnData('data' , ShowChatMemberResource::collection($members), 'My Chat Members');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

}
