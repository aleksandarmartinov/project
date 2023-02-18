<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AdController extends Controller
{
    public function index()
    {

        $adQuery = Ad::query(); //instanca modela Ad

        if (isset(request()->cat)) {

            $adQuery->whereHas('category',function ($query)
            {
                $query->where('name',request()->cat);
            });

        }

        //SORTIRANJE
        if(isset(request()->type)) {    //u welcome.blade.php imamo name="type"

            $type = (request()->type == 'lower') ? 'asc' : 'desc';
            $adQuery->orderBy('price',$type);

        }

        $all_ads = $adQuery->with('adViews')->paginate(5); //vraca sve oglase ako nije prosao kroz ni jedan if gore
        $categories = Category::all()->sortBy('name');

        return view ('welcome',compact('all_ads','categories'));
    }

    public function showAd($id,Request $request)
    {
        $single_ad = Ad::find($id);
        $user = Auth::user();
        $category = $single_ad->category;
        $viewsCount = $single_ad->views()->count();
        $single_ad->views()->attach($user);

        return view('singleAd', compact('single_ad','category','viewsCount'));

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
