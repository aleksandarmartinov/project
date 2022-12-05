<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_ads = Auth::user()->ads;

        return view('home',['all_ads'=>$all_ads]);
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
        $user->save();

        return redirect (route('home'));

    }

    public function adForm()
    {
        $allCategories = Category::all();

        return view('home.adForm',['categories'=>$allCategories]);
    }

    public function saveAd(Request $request)
    {
        $request->validate([
            'title' => 'required | max:255',
            'body' => 'required',
            'price' => 'required',
            'image1' => 'mimes:jpeg,jpg,png',
            'image2' => 'mimes:jpeg,jpg,png',
            'image3' => 'mimes:jpeg,jpg,png',
            'category' => 'required'
        ]);

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

        Ad::create([

            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'image1' => (isset($image1_name)) ? $image1_name : null,
            'image2' => (isset($image2_name)) ? $image2_name : null,
            'image3' => (isset($image3_name)) ? $image3_name : null,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);

        return redirect(route('home'));
    }

    public function showSingleAd($id)
    {
        $single_ad = Ad::find($id);

        return view('home.singleAd',['single_ad'=>$single_ad]);
    }

    public function showMessages()
    {
        $messages = Message::where('receiver_id',auth()->user()->id)->get();

        return view('home.messages',compact('messages'));
    }

    public function reply()
    {
        $sender_id = request()->sender_id;
        $ad_id = request()->ad_id;

        $messages = Message::where('sender_id',$sender_id)->where('ad_id',$ad_id)->get();

        return view ('home.reply',compact('sender_id','ad_id','messages'));
    }

    public function replyStore(Request $request)
    {
        $sender = User::find($request->sender_id); //user koji je poslao poruku
        $ad = Ad::find($request->ad_id); //ad na koji je poslata poruka

        $new_msg = new Message();
        $new_msg->text = $request->msg; //uzeto iz forme
        $new_msg->sender_id = auth()->user()->id; //odgovara ko je trenutno logovan
        $new_msg->receiver_id = $sender->id; //reply prima onaj ko je poslao poruku - sender
        $new_msg->ad_id = $ad->id;
        $new_msg->save();

        return redirect()->route('home.showMessages')->with('message','Reply sent');
    }

}