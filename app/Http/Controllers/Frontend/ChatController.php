<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    
    public function sendMsg(Request $request)
    {
        $request->validate([
            'msg' => 'required'
        ]);
        
        Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'product_id' => $request->product_id,
            'msg' => $request->msg,
        ]);

         return response()->json(['message' => 'Message Send Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function chatPage()
    {
        return view('users.chat.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {
        $chats = Message::orderBy('id','DESC')
                ->where('sender_id',auth()->id())
                ->orWhere('receiver_id',auth()->id())
                ->get();

        $users = $chats->map(function($chat){
            if ($chat->sender_id === auth()->id()) {
                return $chat->receiver;
            }
            return $chat->sender;

        })->unique();

        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function useMsgById($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $messages = Message::where(function($q) use ($userId){
                $q->where('sender_id',auth()->id());
                $q->where('receiver_id',$userId);
            })->orWhere(function($q) use ($userId){
                 $q->where('sender_id',$userId);
                 $q->where('receiver_id',auth()->id());
            })->with(['user','product'])->get();

            return response()->json([
                'user' => $user,
                'messages' => $messages,
            ],200);
        }else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
