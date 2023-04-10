<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Like;
use App\Models\AdUser;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index(Request $request)
    {

        $adQuery = Ad::query(); //stavljamo upit u varijablu gde kasnije koristimo taj upit da gradimo dalje

        $category = $request->get('cat');

        if ($category) {

            $adQuery->whereHas('category', function ($query) use($category)
            {
                $query->where('name', $category);
            });
        }
        //SORTIRANJE
        if($request->has('type')) {    //u welcome.blade.php imamo name="type"

            $type = $request->get('type') === 'lower' ? 'asc' : 'desc';
            $adQuery->orderBy('price',$type);
        }

        $all_ads = $adQuery->with('adViews')->paginate(5); //vraca sve oglase ako nije prosao kroz ni jedan if gore i vraca broj views-a zbog relacije adViews u Ad modelu
        $categories = Category::all()->sortBy('name');

        return view ('welcome',compact('all_ads','categories'));
    }

    public function show($id,Request $request)
    {
        $single_ad = Ad::with('adViews')->find($id); //adViews je relacija iz modela Ad
        $user = Auth::user();
        $category = $single_ad->category;
        $viewsCount = $single_ad->adViews->count(); //adViews je ovde property ne funkcija kao u modelu Ad
        $likeCount = $single_ad->likes()->count();

        if ($user) {
            if( ! AdUser::where('user_id', $user->id)->where('ad_id', $single_ad->id)->first()) {
                $single_ad->adViews()->attach($user);
            }
        }

        // if( ! AdUser::where('user_id', $user->id)->where('ad_id', $single_ad->id)->first()) {
        // $adUser = new AdUser();
        // $adUser->user_id = $user->id;
        // $adUser->ad_id = $single_ad->id;
        // $adUser->save(); //isto kao gore samo samo sve ovo ostalo umesto attacha-a  
        // }

        return view('singleAd', compact('single_ad','category','viewsCount','likeCount'));

    }

    public function like($id, Request $request)
    {
        $single_ad = Ad::find($id);
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('info', 'You need to be logged in to like ads.');
        }

        if ($single_ad->likes()->where('user_id', $user->id)->exists()) {
            $likeCount = $single_ad->likes()->count();
            return redirect()->back()->with('warning', "You have already liked this ad. It has  $likeCount likes.")->with('warningTtl', 5);
        } else {
            //create like
            $single_ad->likes()->attach($user->id);
            $likeCount = $single_ad->likes()->count();

            return redirect()->back()->with('success', "Ad liked successfully. It now has $likeCount likes.");
        }
    }

    public function sendMessage(Request $request,$id)
    {
        $ad = Ad::find($id);
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
