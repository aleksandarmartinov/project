<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Message;
use App\Models\Category;
use App\Events\AdDeleted;
use Illuminate\Http\Request;
use App\Listeners\LogAdDeleted;
use App\Http\Requests\SaveAdRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        
        $all_ads = Auth::user()->ads;

        return view('home',compact('all_ads'));
    }

    public function addDeposit()
    {

        return view ('home.addDeposit');

    }

    public function updateDeposit(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([

            "deposit"=>"required|max:4"
        ],
        [
            "deposit.max"=>"Can't add more then 9999 rsd at once"
        ]);

        $user->deposit = $user->deposit + $request->deposit;
        dd($user);
        $user->save();

        return redirect (route('home'));

    }

    public function adForm()
    {
        $categories = Category::all();

        return view('home.adForm',compact('categories'));

    }

    public function saveAd(SaveAdRequest $request)
    {

        if($request->hasFile('image1')) {

            $image1 = $request->file('image1');
            $image1_name = time().'1.'.$image1->extension(); 
            $image1->move(public_path('ad_images'),$image1_name);
        }
        
        if($request->hasFile('image2')){
            $image2 = $request->file('image2');
            $image2_name = time().'2.'.$image2->extension();
            $image2->move(public_path('ad_images'),$image2_name);
        } 

        if($request->hasFile('image3')){
            $image3 = $request->file('image3');
            $image3_name = time().'3.'.$image3->extension();
            $image3->move(public_path('ad_images'),$image3_name);
        }

        $ad = Ad::create([

            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'image1' => (isset($image1_name)) ? $image1_name : null,
            'image2' => (isset($image2_name)) ? $image2_name : null,
            'image3' => (isset($image3_name)) ? $image3_name : null,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);

        return redirect(route('home'))->with('success','You successfully created an ad, congratulations!');
        

    }

    public function showSingleAd($id)
    {
        $ad = Ad::find($id);

        if (! $ad) {
            return redirect(route('home'))->with('error',"Ad NOT found");
        }

        return view('home.singleAd',compact('ad'));

    }


public function edit($id)
{
    $ad = Ad::where('id', $id)->first();
    $categories = Category::all();

    if (! $ad) {
        return redirect(route('home'))->with('error',"Ad NOT found");
    }

    return view('home.edit',compact('ad','categories'));
}


    public function updateAd(SaveAdRequest $request,$id)
    {
        
        Ad::where('id',$id)
        ->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'price' => $request->input('price'),
            'category_id' => $request->category
        ]);

        return redirect()->route('home')->with('warning','Ad has been successfully updated'); 

    }

    public function destroy($id)
    {

        $ad = Ad::find($id);
        $ad->delete();

        event(new AdDeleted($ad));

        return redirect()->route('home')->with('success','Ad has been successfully deleted');

    }

    public function showMessages()
    {
        $messages = Message::where('receiver_id',auth()->user()->id)->get();

        return view('home.messages',compact('messages'));

    }

    // public function reply()
    // {
    //     $sender_id = request()->sender_id;
    //     $ad_id = request()->ad_id;

    //     $messages = Message::where('sender_id',$sender_id)->where('ad_id',$ad_id)->get();

    //     return view ('home.reply',compact('sender_id','ad_id','messages'));

    // }

    // public function replyStore(Request $request)
    // {
    //     $sender = User::find($request->sender_id); //user koji je poslao poruku
    //     $ad = Ad::find($request->ad_id); //ad na koji je poslata poruka

    //     $new_msg = new Message();
    //     $new_msg->text = $request->msg; //uzeto iz forme
    //     $new_msg->sender_id = auth()->user()->id; //odgovara ko je trenutno logovan
    //     $new_msg->receiver_id = $sender->id; //reply prima onaj ko je poslao poruku - sender
    //     $new_msg->ad_id = $ad->id;
    //     $new_msg->save();

    //     return redirect()->route('home.showMessages')->with('message','Reply sent');

    // }
}