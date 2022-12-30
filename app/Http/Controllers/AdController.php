<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AdController extends Controller
{
    public function index()
    {

        $all_ads = new Ad(); //instanca modela Ad

        if (isset(request()->cat)) {
            
            $all_ads = Ad::whereHas('category',function ($query) 
            {
                $query->where('name',request()->cat);
            });

        }

        //SORTIRANJE
        if(isset(request()->type)) {    //u welcome.blade.php imamo name="type"
        
            $type = (request()->type == 'lower') ? 'asc' : 'desc';
            $all_ads = $all_ads->orderBy('price',$type);  

        }

        $all_ads = $all_ads->paginate(5); //vraca sve oglase ako nije prosao kroz ni jedan if gore
        $categories = Category::all()->sortBy('name');
        
        return view ('welcome',compact('all_ads','categories'));
    }

    public function showAd($id,Request $request)
    {
        $single_ad = Ad::find($id);
        $category = $single_ad->category; 

        //broj pregleda
        if(! auth()->check()) {
            $cookie_name = (str_replace('.','',($request->ip())).'-'. $single_ad->id);
            } else {
                $cookie_name = (auth()->user()->id.'-'. $single_ad->id);
            }

            if(Cookie::get($cookie_name) == '') {

                $cookie = cookie($cookie_name, '1', 60);
                $single_ad->increment('views');
                return response()
                ->view('singleAd', compact('single_ad','category'))->withCookie($cookie);
            } else {
                return view('singleAd', compact('single_ad','category'));
            }
            
    }

    public function sendMessage(Request $request,$id)
    {
        $ad = Ad::find($id); //koji oglas
        $ad_owner = $ad->user; //vlasnik oglasa

        //NOVA PORUKA
        $new_message = new Message();
        $new_message->text = $request->msg; //name="msg"
        $new_message->sender_id = auth()->user()->id;
        $new_message->receiver_id = $ad_owner->id; //poruku prima vlasnik oglasa
        $new_message->ad_id = $ad->id; //id samog oglasa
        $new_message->save();

        return redirect()->back()->with('AdMessage','Message sent');
    }
}
