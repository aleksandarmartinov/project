<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function allMessages()
    {

    $user_id = Auth::id();
    $user = User::find($user_id);

    $messages = $user->receivedMessages;

    return view('home.messages', ['messages' => $messages ]);

    }

    public function createMessage(Request $request,$id)
    {
        $ad = Ad::find($id);
        $ad_owner = $ad->user;

        $request->validate([
            'msg' => 'required|string|max:255',
        ]);

        //NOVA PORUKA
        $message = new Message();
        $message->text = $request->msg; //name="msg"
        $message->sender_id = Auth::id();
        $message->receiver_id = $ad_owner->id; //poruku prima vlasnik oglasa
        $message->ad_id = $ad->id; //id samog oglasa
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully.');

    }
    
    public function showMessage($id)
    {

        $message = Message::findOrFail($id);
        $ad_id = $message->ad_id;
        $single_ad = Ad::findOrFail($ad_id);
 
        if ($message->ad_id != $ad_id) {
            return redirect()->route('ads.messages.index', ['single_ad' => $ad_id])->with('error', 'Invalid message ID.');
        }
 
        return view('home.showMessage', ['single_ad' => $single_ad, 'message' => $message,]);
 
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
 
        if (! $message) {
            return redirect()->back()->with('error', 'Message not found.');
        }
 
        $message->delete();
 
        return redirect()->route('home.messages', ['message' => $message])->with('success', 'Message deleted successfully.');
 
    }



































//    public function create(Request $request, $ad_id)
//    {
//        $single_ad = Ad::findOrFail($ad_id);
//        $message = new Message();
//
//        return view('messages.create', [
//            'ad' => $single_ad,
//            'message' => $message,
//        ]);
//    }
//
//

//

//
//    public function reply($ad_id, $message_id)
//{
//    $single_ad = Ad::findOrFail($ad_id);
//    $message = Message::findOrFail($message_id);
//
//    return view('ads.messages.reply', compact('single_ad', 'message'));
//}
//
//public function replyStore(Request $request, $ad_id, $message_id)
//{
//    $request->validate([
//        'body' => 'required',
//    ]);
//
//    $ad = Ad::findOrFail($ad_id);
//    $message = Message::findOrFail($message_id);
//
//    $newMessage = new Message();
//    $newMessage->body = $request->input('body');
//    $newMessage->sender_id = Auth::id();
//    $newMessage->receiver_id = $message->sender_id;
//    $newMessage->ad_id = $ad->id;
//    $newMessage->parent_id = $message->id;
//    $newMessage->save();
//
//    return redirect()->route('ads.messages.show', [$ad->id, $message->id])->with('success', 'Message sent successfully');
//}
}
