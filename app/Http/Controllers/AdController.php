<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;

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

        $all_ads = $all_ads->get(); //vraca sve oglase ako nije prosao kroz ni jedan if gore
        $categories = Category::all();
        
        return view ('welcome',compact('all_ads','categories'));
    }

    public function showAd($id)
    {
        $single_ad = Ad::find($id);
        $category = $single_ad->category; 

        //neka logika za broj pregleda
        if (auth()->check() && auth()->user()->id !== $single_ad->user_id) { 
            $single_ad->increment('views');
        }

        return view('singleAd', compact('single_ad','category'));
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
